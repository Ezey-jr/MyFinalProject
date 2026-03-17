<!-- dashboard.php -->
<?php
// ── DB connection will go here ──
// $conn = new mysqli("localhost", "user", "password", "blog_db");

// ── Sample data (replace with real DB queries) ──
$total_posts      = 42;   // SELECT COUNT(*) FROM posts
$published_posts  = 35;   // SELECT COUNT(*) FROM posts WHERE status = 'published'
$draft_posts      = 7;    // SELECT COUNT(*) FROM posts WHERE status = 'draft'
$total_views      = 8410; // SELECT SUM(views) FROM posts

$recent_posts = [         // SELECT id, title, status, category, created_at FROM posts ORDER BY created_at DESC LIMIT 5
  ["id"=>1, "title"=>"Getting Started with PHP & MySQL",     "status"=>"published", "category"=>"Tutorial",  "date"=>"Mar 14, 2025"],
  ["id"=>2, "title"=>"10 CSS Tips Every Developer Should Know","status"=>"published","category"=>"Frontend", "date"=>"Mar 12, 2025"],
  ["id"=>3, "title"=>"Understanding RESTful APIs",            "status"=>"draft",    "category"=>"Backend",   "date"=>"Mar 10, 2025"],
  ["id"=>4, "title"=>"Introduction to Database Normalization","status"=>"published","category"=>"Database",  "date"=>"Mar 08, 2025"],
  ["id"=>5, "title"=>"JavaScript Promises Explained",        "status"=>"draft",    "category"=>"Frontend",  "date"=>"Mar 05, 2025"],
];

$category_emojis = ["Tutorial"=>"📘","Frontend"=>"🎨","Backend"=>"⚙️","Database"=>"🗄️","General"=>"📝"];
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — BlogCMS</title>
  <link rel="stylesheet" href="assets/css/style.css">
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

    <a href="dashboard.php" class="nav-item active">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
        <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
      </svg>
      Overview
    </a>

    <a href="posts.php" class="nav-item">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
        <line x1="16" y1="13" x2="8" y2="13"/>
        <line x1="16" y1="17" x2="8" y2="17"/>
        <polyline points="10 9 9 9 8 9"/>
      </svg>
      All Posts
      <span class="nav-badge"><?php echo $total_posts; ?></span>
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

  <!-- Topbar -->
  <header class="topbar">
    <button class="btn-icon" id="sidebarToggle" title="Toggle sidebar">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="6"  x2="21" y2="6"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
      </svg>
    </button>
    <span class="topbar-title">Dashboard Overview</span>
    <div class="topbar-actions">
      <button class="theme-toggle" id="themeToggle" title="Toggle theme">
        <svg id="iconSun" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="5"/>
          <line x1="12" y1="1"  x2="12" y2="3"/>
          <line x1="12" y1="21" x2="12" y2="23"/>
          <line x1="4.22" y1="4.22"  x2="5.64" y2="5.64"/>
          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
          <line x1="1"  y1="12" x2="3"  y2="12"/>
          <line x1="21" y1="12" x2="23" y2="12"/>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
        <svg id="iconMoon" style="display:none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
      </button>
      <a href="add-post.php" class="btn btn-primary">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="12" y1="5" x2="12" y2="19"/>
          <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        New Post
      </a>
    </div>
  </header>

  <!-- Page Content -->
  <main class="page-content">

    <!-- Stat Cards -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon orange">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
          </svg>
        </div>
        <div class="stat-body">
          <div class="stat-value"><?php echo $total_posts; ?></div>
          <div class="stat-label">Total Posts</div>
          <div class="stat-change up">↑ 4 this month</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon green">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </div>
        <div class="stat-body">
          <div class="stat-value"><?php echo $published_posts; ?></div>
          <div class="stat-label">Published</div>
          <div class="stat-change up">↑ 3 this month</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon yellow">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
        </div>
        <div class="stat-body">
          <div class="stat-value"><?php echo $draft_posts; ?></div>
          <div class="stat-label">Drafts</div>
          <div class="stat-change down">↓ 1 from last month</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon red">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </div>
        <div class="stat-body">
          <div class="stat-value"><?php echo number_format($total_views); ?></div>
          <div class="stat-label">Total Views</div>
          <div class="stat-change up">↑ 12% this week</div>
        </div>
      </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">

      <!-- Left col -->
      <div style="display:flex; flex-direction:column; gap:1rem;">

        <!-- Quick Actions -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Quick Actions</span>
          </div>
          <div class="card-body" style="padding-top:.75rem;">
            <div class="quick-actions">
              <a href="add-post.php" class="quick-action-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <line x1="12" y1="5" x2="12" y2="19"/>
                  <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Write New Post
              </a>
              <a href="posts.php" class="quick-action-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <line x1="8" y1="6" x2="21" y2="6"/>
                  <line x1="8" y1="12" x2="21" y2="12"/>
                  <line x1="8" y1="18" x2="21" y2="18"/>
                  <line x1="3" y1="6" x2="3.01" y2="6"/>
                  <line x1="3" y1="12" x2="3.01" y2="12"/>
                  <line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
                Manage All Posts
              </a>
              <a href="#" class="quick-action-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                  <polyline points="22,6 12,13 2,6"/>
                </svg>
                View Drafts
              </a>
            </div>
          </div>
        </div>

        <!-- Activity Feed -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Recent Activity</span>
          </div>
          <div class="card-body">
            <div class="activity-item">
              <div class="activity-dot green"></div>
              <div>
                <div class="activity-text">Post <strong>"Getting Started with PHP"</strong> was published</div>
                <div class="activity-time">2 hours ago</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot orange"></div>
              <div>
                <div class="activity-text">Draft <strong>"JavaScript Promises"</strong> updated</div>
                <div class="activity-time">5 hours ago</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot green"></div>
              <div>
                <div class="activity-text">Post <strong>"10 CSS Tips"</strong> reached 500 views</div>
                <div class="activity-time">Yesterday</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot red"></div>
              <div>
                <div class="activity-text">Post <strong>"Old Tutorial v1"</strong> was archived</div>
                <div class="activity-time">2 days ago</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Right col: Recent Posts -->
      <div class="card">
        <div class="card-header">
          <span class="card-title">Recent Posts</span>
          <a href="posts.php" class="btn btn-secondary" style="font-size:.78rem; padding:.35rem .75rem;">View All</a>
        </div>
        <div class="card-body">
          <?php foreach ($recent_posts as $post): ?>
          <div class="recent-post-item">
            <div class="recent-post-thumb">
              <?php echo $category_emojis[$post['category']] ?? '📝'; ?>
            </div>
            <div class="recent-post-info">
              <div class="recent-post-title"><?php echo htmlspecialchars($post['title']); ?></div>
              <div class="recent-post-meta">
                <span class="category-pill"><?php echo htmlspecialchars($post['category']); ?></span>
                &nbsp;·&nbsp;<?php echo $post['date']; ?>
                &nbsp;·&nbsp;
                <span class="badge <?php echo $post['status'] === 'published' ? 'badge-published' : 'badge-draft'; ?>">
                  <?php echo ucfirst($post['status']); ?>
                </span>
              </div>
            </div>
            <div style="display:flex; gap:.3rem; flex-shrink:0;">
              <a href="edit-post.php?id=<?php echo $post['id']; ?>" class="action-btn" title="Edit">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </main>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<script src="app.js"></script>
</body>
</html>
