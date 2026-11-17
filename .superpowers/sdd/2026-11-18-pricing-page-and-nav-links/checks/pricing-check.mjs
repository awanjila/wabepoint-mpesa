import { readFileSync } from 'node:fs';

const source = readFileSync('resources/js/Pages/Pricing.vue', 'utf8');

const expected = [
  ['no hero overlap class', !source.includes('-mt-12')],
  ['no scaled card class', !source.includes('scale-[1.02]')],
  ['no gridClass helper', !source.includes('gridClass')],
  [
    'plan groups use one centred row',
    /<div class="flex flex-wrap justify-center gap-6">\s*<div v-for="plan in group\.plans"/.test(source),
  ],
  [
    'every plan card has uniform width',
    /class="relative bg-white rounded-sm border-2 transition-all duration-150 flex flex-col w-full sm:w-\[calc\(50%-0\.75rem\)\] lg:w-\[calc\(33\.333%-1rem\)\]"/.test(source),
  ],
  [
    'highlighted card keeps only border and shadow emphasis',
    /plan\.highlighted \? 'border-\[#2596be\] shadow-md' :/.test(source),
  ],
];

let failed = false;
for (const [name, ok] of expected) {
  console.log(`${ok ? 'PASS' : 'FAIL'} ${name}`);
  if (!ok) failed = true;
}
process.exit(failed ? 1 : 0);
