import { readFileSync } from 'node:fs';

const source = readFileSync('resources/js/Components/Navigation.vue', 'utf8');
const oldButton = '<button class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-700 hover:text-[#2596be] transition-colors">';

const labelLinks = (label, href) =>
  new RegExp(`<Link href="${href}"[^>]*>\\s*${label}\\s*<svg`).test(source);

const hoverWrapper = (ref, flag) =>
  new RegExp(`ref="${ref}"[^>]*@mouseenter="${flag} = true"[^>]*@mouseleave="${flag} = false"`).test(source);

const expected = [
  ['no button-style top-level nav labels', !source.includes(oldButton)],
  ['Point Of Sale links to /point-of-sale-system-kenya', labelLinks('Point Of Sale', '/point-of-sale-system-kenya')],
  ['Our Services links to /point-of-sale-system-kenya', labelLinks('Our Services', '/point-of-sale-system-kenya')],
  ['Resources links to /pos-systems-in-kenya-news', labelLinks('Resources', '/pos-systems-in-kenya-news')],
  ['Point Of Sale hover dropdown retained', hoverWrapper('posDropdownRef', 'posDropdownOpen')],
  ['Our Services hover dropdown retained', hoverWrapper('servicesDropdownRef', 'servicesDropdownOpen')],
  ['Resources hover dropdown retained', hoverWrapper('resourcesDropdownRef', 'resourcesDropdownOpen')],
  ['industries prop stays reactive', source.includes('computed(() => usePage().props.industries')],
  ['support tel link matches displayed number', source.includes('href="tel:+254781312070"')],
];

let failed = false;
for (const [name, ok] of expected) {
  console.log(`${ok ? 'PASS' : 'FAIL'} ${name}`);
  if (!ok) failed = true;
}
process.exit(failed ? 1 : 0);
