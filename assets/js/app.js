/* app.js — shared across all dashboard pages */

// ── Theme Toggle ──────────────────────────────────
const html        = document.documentElement;
const themeToggle = document.getElementById('themeToggle');
const iconSun     = document.getElementById('iconSun');
const iconMoon    = document.getElementById('iconMoon');

// Persist preference
const savedTheme = localStorage.getItem('theme') || 'light';
html.setAttribute('data-theme', savedTheme);
syncThemeIcons(savedTheme);

if (themeToggle) {
  themeToggle.addEventListener('click', function () {
    const current = html.getAttribute('data-theme');
    const next    = current === 'light' ? 'dark' : 'light';
    html.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);
    syncThemeIcons(next);
  });
}

function syncThemeIcons(theme) {
  if (!iconSun || !iconMoon) return;
  if (theme === 'dark') {
    iconSun.style.display  = 'none';
    iconMoon.style.display = '';
  } else {
    iconSun.style.display  = '';
    iconMoon.style.display = 'none';
  }
}

// ── Sidebar Toggle (mobile) ───────────────────────
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar       = document.getElementById('sidebar');

if (sidebarToggle && sidebar) {
  sidebarToggle.addEventListener('click', function () {
    sidebar.classList.toggle('open');
  });

  // Close sidebar when clicking outside on mobile
  document.addEventListener('click', function (e) {
    if (window.innerWidth <= 768
        && !sidebar.contains(e.target)
        && !sidebarToggle.contains(e.target)
        && sidebar.classList.contains('open')) {
      sidebar.classList.remove('open');
    }
  });
}

// ── Toast Notifications ───────────────────────────
function showToast(message, type = 'success') {
  const container = document.getElementById('toastContainer');
  if (!container) return;

  const icons = {
    success: '✓',
    error:   '✕',
    warning: '⚠',
    info:    'ℹ',
  };

  const toast = document.createElement('div');
  toast.className = 'toast ' + (type === 'error' ? 'error' : type === 'warning' ? 'warning' : '');
  toast.innerHTML = `<span style="font-weight:600;">${icons[type] || '•'}</span> ${message}`;
  container.appendChild(toast);

  // Auto-remove after 3s
  setTimeout(() => {
    toast.style.opacity    = '0';
    toast.style.transform  = 'translateX(1rem)';
    toast.style.transition = 'opacity .2s ease, transform .2s ease';
    setTimeout(() => toast.remove(), 200);
  }, 3000);
}

// ── Show toast from URL param (after redirects) ───
// e.g. redirect to posts.php?msg=saved&type=success
(function () {
  const params = new URLSearchParams(window.location.search);
  if (params.get('msg')) {
    showToast(decodeURIComponent(params.get('msg')), params.get('type') || 'success');
  }
})();
