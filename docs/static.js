const roles = {
  farmer: {
    index: '01 / 04',
    title: 'Turn expertise into a funded project.',
    summary: 'Farmers accept land arrangements, propose farming projects, report progress, log harvests, and see their settled earnings.',
    items: ['Respond to land hiring requests', 'Build and submit project budgets', 'Post milestones and harvest records'],
    label: 'Farmer overview', main: '3', action: 'Post update'
  },
  landowner: {
    index: '02 / 04',
    title: 'Put available land into trusted hands.',
    summary: 'Landowners publish parcel details, discover verified farmers, propose lease terms, and follow accepted arrangements.',
    items: ['Document land and soil details', 'Search approved farmer profiles', 'Track hiring and lease status'],
    label: 'Landowner overview', main: '4', action: 'Review lease'
  },
  investor: {
    index: '03 / 04',
    title: 'Fund projects with a clearer line of sight.',
    summary: 'Investors browse approved opportunities, fund the remaining budget, monitor progress, and review final profit shares.',
    items: ['Search approved crop projects', 'See budget and funding progress', 'Review portfolio and returns'],
    label: 'Investor overview', main: '7', action: 'Browse projects'
  },
  administrator: {
    index: '04 / 04',
    title: 'Keep every participant and project accountable.',
    summary: 'Administrators verify farmers, moderate projects and users, handle reports, and finalize eligible settlements.',
    items: ['Verify farmer applications', 'Approve project proposals', 'Review and finalize shareouts'],
    label: 'Admin overview', main: '12', action: 'Verify farmer'
  }
};

const roleButtons = document.querySelectorAll('[data-role]');
const roleIndex = document.querySelector('[data-role-index]');
const roleTitle = document.querySelector('[data-role-title]');
const roleSummary = document.querySelector('[data-role-summary]');
const roleList = document.querySelector('[data-role-list]');
const dashLabel = document.querySelector('[data-dash-label]');
const dashMain = document.querySelector('[data-dash-main]');
const dashAction = document.querySelector('[data-dash-action]');

roleButtons.forEach((button) => {
  button.addEventListener('click', () => {
    const role = roles[button.dataset.role];
    roleButtons.forEach((item) => item.setAttribute('aria-selected', String(item === button)));
    roleIndex.textContent = role.index;
    roleTitle.textContent = role.title;
    roleSummary.textContent = role.summary;
    roleList.replaceChildren(...role.items.map((item) => {
      const li = document.createElement('li');
      li.textContent = item;
      return li;
    }));
    dashLabel.textContent = role.label;
    dashMain.textContent = role.main;
    dashAction.textContent = role.action;
  });
});

const budget = document.querySelector('[data-budget]');
const revenue = document.querySelector('[data-revenue]');
const money = new Intl.NumberFormat('en-BD', { style: 'currency', currency: 'BDT', maximumFractionDigits: 0 });

function updateCalculator() {
  const budgetValue = Number(budget.value);
  const revenueValue = Number(revenue.value);
  const profit = Math.max(0, revenueValue - budgetValue);
  const values = {
    '[data-budget-output]': budgetValue,
    '[data-revenue-output]': revenueValue,
    '[data-profit]': profit,
    '[data-investor]': profit * 0.60,
    '[data-farmer]': profit * 0.395,
    '[data-platform]': profit * 0.005
  };

  Object.entries(values).forEach(([selector, value]) => {
    document.querySelector(selector).textContent = money.format(value);
  });

  document.querySelector('[data-warning]').hidden = profit > 0;
  document.querySelector('[data-distribution]').style.opacity = profit > 0 ? '1' : '.35';
}

[budget, revenue].forEach((input) => input.addEventListener('input', updateCalculator));
updateCalculator();

const header = document.querySelector('[data-header]');
const nav = document.querySelector('[data-nav]');
const navToggle = document.querySelector('[data-nav-toggle]');

window.addEventListener('scroll', () => header.classList.toggle('scrolled', window.scrollY > 24), { passive: true });
navToggle.addEventListener('click', () => {
  const open = nav.classList.toggle('open');
  navToggle.setAttribute('aria-expanded', String(open));
});
nav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
  nav.classList.remove('open');
  navToggle.setAttribute('aria-expanded', 'false');
}));

document.querySelector('[data-year]').textContent = new Date().getFullYear();
