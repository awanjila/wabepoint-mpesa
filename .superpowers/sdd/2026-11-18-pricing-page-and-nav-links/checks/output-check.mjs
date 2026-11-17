import { existsSync, readFileSync, readdirSync, statSync } from 'node:fs';
import { join } from 'node:path';

const walk = (dir) => readdirSync(dir).flatMap((name) => {
  const path = join(dir, name);
  return statSync(path).isDirectory() ? walk(path) : [path];
});

const htmlFiles = ['public/index.html', ...walk('public').filter((p) => p.endsWith('index.html') && p !== 'public/index.html')];
const allHtml = htmlFiles.map((p) => [p, readFileSync(p, 'utf8')]);
const home = readFileSync('public/index.html', 'utf8');
const pricing = readFileSync('public/pricing/index.html', 'utf8');
const htaccess = readFileSync('public/.htaccess', 'utf8');
const manifest = JSON.parse(readFileSync('public/build/manifest.json', 'utf8'));
const appBundle = readFileSync(join('public/build', manifest['resources/js/app.js'].file), 'utf8');

const linkWithLabel = (html, label, href) =>
  new RegExp(`<a[^>]*href="${href}"[^>]*>\\s*${label}\\s*(<svg|</a>)`).test(html);

const assetPaths = [...home.matchAll(/\/build\/assets\/([^"'\s]+)/g)].map((m) => `public/build/assets/${m[1]}`);

const expected = [
  ['generated nav: Point Of Sale', linkWithLabel(home, 'Point Of Sale', '/point-of-sale-system-kenya')],
  ['generated nav: Our Services', linkWithLabel(home, 'Our Services', '/point-of-sale-system-kenya')],
  ['generated nav: Resources', linkWithLabel(home, 'Resources', '/pos-systems-in-kenya-news')],
  ['generated nav: Pricing', linkWithLabel(home, 'Pricing', '/pricing')],
  ['generated pricing: centred card row', pricing.includes('flex flex-wrap justify-center gap-6')],
  ['generated pricing: no old overlap or scale classes', !pricing.includes('-mt-12') && !pricing.includes('scale-[1.02]')],
  ['Apache rule routes X-Inertia to Laravel', /RewriteCond %\{HTTP:X-Inertia\} \.\s*\n\s*RewriteRule \^ index\.php \[L\]/.test(htaccess)],
  ['Authorization header still handled', /HTTP_AUTHORIZATION/.test(htaccess)],
  ['deployed app bundle prevents the stacking iframe modal', appBundle.includes('inertia:invalid')],
  ['no dev-server URLs in generated HTML', allHtml.every(([, text]) => !text.includes('5174') && !text.includes('localhost'))],
  ['manifest has no missing assets', Object.values(manifest).every((entry) => existsSync(join('public/build', entry.file)))],
  ['all assets referenced by home HTML exist', assetPaths.every((p) => existsSync(p))],
  [`all ${htmlFiles.length} generated pages are non-empty`, allHtml.every(([, text]) => text.length > 1000)],
];

let failed = false;
for (const [name, ok] of expected) {
  console.log(`${ok ? 'PASS' : 'FAIL'} ${name}`);
  if (!ok) failed = true;
}
process.exit(failed ? 1 : 0);
