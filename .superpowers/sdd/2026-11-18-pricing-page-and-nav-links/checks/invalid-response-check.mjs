import { readFileSync } from 'node:fs';

const source = readFileSync('resources/js/app.js', 'utf8');

const expected = [
  [
    'invalid Inertia responses are intercepted',
    /document\.addEventListener\(\s*['"]inertia:invalid['"]/.test(source),
  ],
  [
    'the stacking iframe modal is cancelled',
    /addEventListener\(\s*['"]inertia:invalid['"][\s\S]*?preventDefault\(\)/.test(source),
  ],
  [
    'invalid GET responses fall back to a full page load',
    /addEventListener\(\s*['"]inertia:invalid['"][\s\S]*?(window\.location\.(assign|href)|location\.assign)/.test(source),
  ],
];

let failed = false;
for (const [name, ok] of expected) {
  console.log(`${ok ? 'PASS' : 'FAIL'} ${name}`);
  if (!ok) failed = true;
}
process.exit(failed ? 1 : 0);
