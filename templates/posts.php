<!-- posts.php -->
<?php
// ── DB connection will go here ──
// $conn = new mysqli("localhost", "user", "password", "blog_db");

// ── Sample data (replace with real DB query) ──
// $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
// $posts = $result->fetch_all(MYSQLI_ASSOC);

$posts = [
  ["id"=>1, "title"=>"Getting Started with PHP & MySQL",       "excerpt"=>"A beginner's guide to connecting PHP with a MySQL database.",        "category"=>"Tutorial", "status"=>"published", "views"=>1240, "date"=>"Mar 14, 2025"],
  ["id"=>2, "title"=>"10 CSS Tips Every Developer Should Know","excerpt"=>"Practical tricks to write cleaner, more efficient stylesheets.",       "category"=>"Frontend", "status"=>"published", "views"=>983,  "date"=>"Mar 12, 2025"],
  ["id"=>3, "title"=>"Understanding RESTful APIs",             "excerpt"=>"What REST is and how to design clean API endpoints.",                  "category"=>"Backend",  "status"=>"draft",     "views"=>0,    "date"=>"Mar 10, 2025"],
  ["id"=>4, "title"=>"Introduction to Database Normalization", "excerpt"=>"Learn 1NF, 2NF, and 3NF with practical examples.",                    "category"=>"Database", "status"=>"published", "views"=>760,  "date"=>"Mar 08, 2025"],
  ["id"=>5, "title"=>"JavaScript Promises Explained",          "excerpt"=>"Async JS without the confusion: Promises, async/await.",              "category"=>"Frontend", "status"=>"draft",     "views"=>0,    "date"=>"Mar 05, 2025"],
  ["id"=>6, "title"=>"SQL Joins: A Visual Guide",              "excerpt"=>"INNER, LEFT, RIGHT, FULL OUTER — explained with diagrams.",           "category"=>"Database", "status"=>"published", "views"=>2100, "date"=>"Feb 28, 2025"],
  ["id"=>7, "title"=>"Setting Up a LAMP Stack on Ubuntu",      "excerpt"=>"Step-by-step guide to installing Apache, MySQL, and PHP.",            "category"=>"Tutorial", "status"=>"published", "views"=>1560, "date"=>"Feb 22, 2025"],
  ["id"=>8, "title"=>"CSS Grid vs Flexbox",                   "excerpt"=>"When to use Grid, when to use Flex, and when to combine both.",       "category"=>"Frontend", "status"=>"archived",  "views"=>430,  "date"=>"Feb 15, 2025"],
];

$status_badge = [
  "published" => "badge-published",
  "draft"     => "badge-draft",
  "archived"  => "badge-archived",
];
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Posts — BlogCMS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ═══════════ SIDEBAR ═══════════ -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <div class="brand-label">BlogCMS</div>
    <div class="brand-sub">Admin Panel</div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="dashboard.php" class="nav-item">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
        <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
      </svg>
      Overview
    </a>
    <a href="posts.php" class="nav-item active">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
        <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
      </svg>
      All Posts
      <span class="nav-badge"><?php echo count($posts); ?></span>
    </a>
    <a href="add-post.php" class="nav-item">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="16"/>
        <line x1="8" y1="12" x2="16" y2="12"/>
      </svg>
      Add New Post
    </a>
    <div class="nav-section-label" style="margin-top:.5rem">Settings</div>
    <a href="#" class="nav-item">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="3"/>
        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
      </svg>
      Categories
    </a>
    <a href="#" class="nav-item">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      Profile
    </a>
  </nav>
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="user-avatar">A</div>
      <div class="user-info">
        <div class="user-name">Admin User</div>
        <div class="user-role">Administrator</div>
      </div>
    </div>
  </div>
</aside>

<!-- ═══════════ MAIN ═══════════ -->
<div class="main-wrap">
  <header class="topbar">
    <button class="btn-icon" id="sidebarToggle">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
      </svg>
    </button>
    <span class="topbar-title">All Posts</span>
    <div class="topbar-actions">
      <button class="theme-toggle" id="themeToggle">
        <svg id="iconSun" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="5"/>
          <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
          <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
        <svg id="iconMoon" style="display:none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
      </button>
      <a href="add-post.php" class="btn btn-primary">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        New Post
      </a>
    </div>
  </header>

  <main class="page-content">
    <div class="page-header">
      <div>
        <div class="page-heading">All Posts</div>
        <div class="page-sub"><?php echo count($posts); ?> posts total</div>
      </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
      <div class="search-wrap">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" class="search-input" id="searchInput" placeholder="Search posts…">
      </div>
      <select class="filter-select" id="statusFilter">
        <option value="">All Statuses</option>
        <option value="published">Published</option>
        <option value="draft">Draft</option>
        <option value="archived">Archived</option>
      </select>
      <select class="filter-select" id="categoryFilter">
        <option value="">All Categories</option>
        <option value="Tutorial">Tutorial</option>
        <option value="Frontend">Frontend</option>
        <option value="Backend">Backend</option>
        <option value="Database">Database</option>
      </select>
    </div>

    <!-- Table -->
    <div class="table-wrap">
      <table id="postsTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Views</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($posts as $i => $post): ?>
          <tr data-status="<?php echo $post['status']; ?>" data-category="<?php echo $post['category']; ?>">
            <td style="color:var(--text-muted); font-size:.8rem;"><?php echo $post['id']; ?></td>
            <td class="post-title-cell">
              <span class="title-text"><?php echo htmlspecialchars($post['title']); ?></span>
              <span class="post-excerpt"><?php echo htmlspecialchars($post['excerpt']); ?></span>
            </td>
            <td><span class="category-pill"><?php echo htmlspecialchars($post['category']); ?></span></td>
            <td>
              <span class="badge <?php echo $status_badge[$post['status']]; ?>">
                <?php echo ucfirst($post['status']); ?>
              </span>
            </td>
            <td style="font-size:.85rem; color:var(--text-secondary);">
              <?php echo $post['views'] > 0 ? number_format($post['views']) : '—'; ?>
            </td>
            <td style="font-size:.8rem; color:var(--text-muted); white-space:nowrap;"><?php echo $post['date']; ?></td>
            <td>
              <div class="row-actions">
                <a href="edit-post.php?id=<?php echo $post['id']; ?>" class="action-btn" title="Edit post">
                  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                </a>
                <button class="action-btn" title="View post">
                  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                </button>
                <button class="action-btn danger" title="Delete post"
                  onclick="confirmDelete(<?php echo $post['id']; ?>, '<?php echo addslashes($post['title']); ?>')">
                  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    <path d="M10 11v6"/><path d="M14 11v6"/>
                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="pagination">
        <span class="pagination-info" id="paginationInfo">Showing <?php echo count($posts); ?> posts</span>
        <div class="pagination-btns">
          <button class="pg-btn">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="15 18 9 12 15 6"/>
            </svg>
          </button>
          <button class="pg-btn active">1</button>
          <button class="pg-btn">2</button>
          <button class="pg-btn">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9 18 15 12 9 6"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

  </main>
</div>

<div class="toast-container" id="toastContainer"></div>

<script src="app.js"></script>
<script>
// Client-side filter (will be replaced by server-side PHP + DB filtering)
const searchInput    = document.getElementById('searchInput');
const statusFilter   = document.getElementById('statusFilter');
const categoryFilter = document.getElementById('categoryFilter');

function filterTable() {
  const q   = searchInput.value.toLowerCase();
  const st  = statusFilter.value;
  const cat = categoryFilter.value;
  const rows = document.querySelectorAll('#postsTable tbody tr');
  let visible = 0;
  rows.forEach(row => {
    const title    = row.querySelector('.title-text').textContent.toLowerCase();
    const status   = row.dataset.status;
    const category = row.dataset.category;
    const show = title.includes(q)
      && (st  === '' || status   === st)
      && (cat === '' || category === cat);
    row.style.display = show ? '' : 'none';
    if (show) visible++;
  });
  document.getElementById('paginationInfo').textContent = `Showing ${visible} post${visible !== 1 ? 's' : ''}`;
}

searchInput.addEventListener('input', filterTable);
statusFilter.addEventListener('change', filterTable);
categoryFilter.addEventListener('change', filterTable);

function confirmDelete(id, title) {
  if (confirm(`Delete "${title}"?\n\nThis cannot be undone.`)) {
    // Replace with: window.location.href = `delete-post.php?id=${id}`;
    showToast(`Post "${title}" deleted.`, 'error');
    document.querySelector(`tr[data-status]`); // placeholder
  }
}
</script>
</body>
</html>
