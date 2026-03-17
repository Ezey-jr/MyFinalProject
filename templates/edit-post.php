<!-- edit-post.php -->
<?php
// ── DB connection will go here ──
// $conn = new mysqli("localhost", "user", "password", "blog_db");

// ── Get post ID from URL ──
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// ── Fetch post from DB ──
// $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ? LIMIT 1");
// $stmt->bind_param("i", $id);
// $stmt->execute();
// $post = $stmt->get_result()->fetch_assoc();

// ── Sample data — replace with DB fetch ──
$posts_db = [
  1 => ["id"=>1, "title"=>"Getting Started with PHP & MySQL",       "slug"=>"getting-started-php-mysql",       "category"=>"Tutorial","status"=>"published","excerpt"=>"A beginner's guide to connecting PHP with a MySQL database.",        "body"=>"## Introduction\n\nIn this tutorial, we'll walk through how to connect a PHP application to a MySQL database using MySQLi...", "meta_desc"=>"Learn to connect PHP with MySQL in this beginner-friendly tutorial.", "tags"=>"php, mysql, database"],
  2 => ["id"=>2, "title"=>"10 CSS Tips Every Developer Should Know","slug"=>"10-css-tips-developers",           "category"=>"Frontend","status"=>"published","excerpt"=>"Practical tricks to write cleaner, more efficient stylesheets.",       "body"=>"CSS can sometimes feel unpredictable. Here are 10 tips...",                                                                   "meta_desc"=>"10 practical CSS tricks for cleaner, more efficient stylesheets.",    "tags"=>"css, frontend, tips"],
  3 => ["id"=>3, "title"=>"Understanding RESTful APIs",             "slug"=>"understanding-restful-apis",       "category"=>"Backend", "status"=>"draft",    "excerpt"=>"What REST is and how to design clean API endpoints.",                  "body"=>"A REST API is an architectural style for distributed hypermedia systems...",                                                    "meta_desc"=>"A comprehensive guide to understanding and designing RESTful APIs.", "tags"=>"api, rest, backend"],
];

$post = $posts_db[$id] ?? null;

if (!$post) {
  // In real app: redirect or show 404
  $post = ["id"=>0,"title"=>"","slug"=>"","category"=>"","status"=>"draft","excerpt"=>"","body"=>"","meta_desc"=>"","tags"=>""];
}

$success_msg = "";
$error_msg   = "";

// ── Handle update ──
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title    = trim($_POST["title"]    ?? "");
  $slug     = trim($_POST["slug"]     ?? "");
  $category = trim($_POST["category"] ?? "");
  $status   = trim($_POST["status"]   ?? "draft");
  $excerpt  = trim($_POST["excerpt"]  ?? "");
  $body     = trim($_POST["body"]     ?? "");
  $meta_desc= trim($_POST["meta_desc"]?? "");
  $tags     = trim($_POST["tags"]     ?? "");

  if (empty($title) || empty($body)) {
    $error_msg = "Title and content are required.";
  } else {
    // ── UPDATE query will go here ──
    // $stmt = $conn->prepare(
    //   "UPDATE posts SET title=?, slug=?, category=?, status=?, excerpt=?, body=?, meta_desc=?, tags=?, updated_at=NOW()
    //    WHERE id=?"
    // );
    // $stmt->bind_param("ssssssssi", $title, $slug, $category, $status, $excerpt, $body, $meta_desc, $tags, $id);
    // $stmt->execute();

    $post = array_merge($post, compact('title','slug','category','status','excerpt','body','meta_desc','tags'));
    $success_msg = "Post updated successfully!";
  }
}

$categories = ["Tutorial", "Frontend", "Backend", "Database", "General"];
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Post — BlogCMS</title>
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
    <a href="posts.php" class="nav-item">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
        <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
      </svg>
      All Posts
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
    <span class="topbar-title">Edit Post</span>
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
    </div>
  </header>

  <main class="page-content">
    <div class="page-header">
      <div>
        <div class="page-heading">Edit Post</div>
        <div class="page-sub">Post ID: #<?php echo $id; ?> &nbsp;·&nbsp;
          <span class="badge <?php echo $post['status'] === 'published' ? 'badge-published' : 'badge-draft'; ?>">
            <?php echo ucfirst($post['status']); ?>
          </span>
        </div>
      </div>
      <div style="display:flex; gap:.6rem;">
        <a href="posts.php" class="btn btn-secondary">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
          Back to Posts
        </a>
        <button class="btn btn-danger" type="button"
          onclick="if(confirm('Delete this post? This cannot be undone.')) window.location.href='delete-post.php?id=<?php echo $id; ?>'">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="3 6 5 6 21 6"/>
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
          </svg>
          Delete
        </button>
      </div>
    </div>

    <?php if ($success_msg): ?>
    <div style="background:var(--success-light); color:var(--success); border:1px solid var(--success); padding:.75rem 1rem; border-radius:var(--radius-sm); margin-bottom:1rem; font-size:.875rem;">
      ✓ <?php echo htmlspecialchars($success_msg); ?>
    </div>
    <?php endif; ?>

    <?php if ($error_msg): ?>
    <div style="background:var(--danger-light); color:var(--danger); border:1px solid var(--danger); padding:.75rem 1rem; border-radius:var(--radius-sm); margin-bottom:1rem; font-size:.875rem;">
      ✕ <?php echo htmlspecialchars($error_msg); ?>
    </div>
    <?php endif; ?>

    <!-- Form -->
    <form method="POST" action="edit-post.php?id=<?php echo $id; ?>" id="postForm">
      <div class="form-grid">

        <!-- Left: Main content -->
        <div style="display:flex; flex-direction:column; gap:1.25rem;">

          <div class="form-card">
            <div class="form-card-header">Post Content</div>
            <div class="form-card-body">

              <div class="form-group">
                <label class="form-label" for="title">Post Title <span class="req">*</span></label>
                <input type="text" class="form-input" id="title" name="title"
                  placeholder="Enter an engaging post title…"
                  value="<?php echo htmlspecialchars($post['title']); ?>" required>
              </div>

              <div class="form-group">
                <label class="form-label" for="slug">Slug</label>
                <input type="text" class="form-input" id="slug" name="slug"
                  value="<?php echo htmlspecialchars($post['slug']); ?>"
                  placeholder="post-url-slug">
                <div class="slug-preview">Preview: yourblog.com/posts/<span id="slugPreview"><?php echo htmlspecialchars($post['slug']); ?></span></div>
              </div>

              <div class="form-group">
                <label class="form-label" for="excerpt">Excerpt / Summary</label>
                <textarea class="form-textarea" id="excerpt" name="excerpt"
                  rows="3" style="min-height:5rem;"
                  placeholder="A short summary shown on listing pages…"><?php echo htmlspecialchars($post['excerpt']); ?></textarea>
              </div>

              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="body">Content <span class="req">*</span></label>
                <textarea class="form-textarea" id="body" name="body"
                  placeholder="Write your post content here…" required><?php echo htmlspecialchars($post['body']); ?></textarea>
                <div class="form-hint">HTML is supported. A rich text editor can be wired in here (e.g. TinyMCE).</div>
              </div>
            </div>
          </div>

          <!-- SEO -->
          <div class="form-card">
            <div class="form-card-header">SEO Settings</div>
            <div class="form-card-body">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="meta_desc">Meta Description</label>
                <textarea class="form-textarea" id="meta_desc" name="meta_desc"
                  rows="3" style="min-height:5rem;"><?php echo htmlspecialchars($post['meta_desc']); ?></textarea>
                <div class="seo-score">
                  <div class="seo-score-label">
                    <span>SEO Score</span>
                    <span id="seoScoreText">—</span>
                  </div>
                  <div class="seo-bar">
                    <div class="seo-bar-fill" id="seoBar" style="width:0%;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Right: Settings -->
        <div style="display:flex; flex-direction:column; gap:1.25rem;">

          <!-- Publish -->
          <div class="form-card">
            <div class="form-card-header">Publish</div>
            <div class="form-card-body">
              <div class="form-group">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status">
                  <option value="draft"     <?php echo $post['status']==='draft'     ? 'selected':''; ?>>Draft</option>
                  <option value="published" <?php echo $post['status']==='published' ? 'selected':''; ?>>Published</option>
                  <option value="archived"  <?php echo $post['status']==='archived'  ? 'selected':''; ?>>Archived</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label" for="category">Category</label>
                <select class="form-select" id="category" name="category">
                  <option value="">Select a category</option>
                  <?php foreach ($categories as $cat): ?>
                  <option value="<?php echo $cat; ?>" <?php echo $post['category']===$cat ? 'selected':''; ?>>
                    <?php echo $cat; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-actions">
                <button type="submit" name="action" value="save_draft" class="btn btn-secondary">
                  Save Draft
                </button>
                <button type="submit" name="action" value="update" class="btn btn-success">
                  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                  Update Post
                </button>
              </div>
            </div>
          </div>

          <!-- Post Info (read-only) -->
          <div class="form-card">
            <div class="form-card-header">Post Info</div>
            <div class="form-card-body">
              <table style="width:100%; font-size:.8rem; border-collapse:collapse;">
                <tr>
                  <td style="padding:.3rem 0; color:var(--text-muted);">Post ID</td>
                  <td style="padding:.3rem 0; color:var(--text-primary); text-align:right; font-weight:500;">#<?php echo $post['id']; ?></td>
                </tr>
                <tr>
                  <td style="padding:.3rem 0; color:var(--text-muted); border-top:1px solid var(--border);">Created</td>
                  <td style="padding:.3rem 0; color:var(--text-primary); text-align:right; border-top:1px solid var(--border);">Mar 14, 2025</td>
                </tr>
                <tr>
                  <td style="padding:.3rem 0; color:var(--text-muted); border-top:1px solid var(--border);">Last Updated</td>
                  <td style="padding:.3rem 0; color:var(--text-primary); text-align:right; border-top:1px solid var(--border);">—</td>
                </tr>
                <tr>
                  <td style="padding:.3rem 0; color:var(--text-muted); border-top:1px solid var(--border);">Views</td>
                  <td style="padding:.3rem 0; color:var(--text-primary); text-align:right; border-top:1px solid var(--border);">1,240</td>
                </tr>
              </table>
            </div>
          </div>

          <!-- Tags -->
          <div class="form-card">
            <div class="form-card-header">Tags</div>
            <div class="form-card-body">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="tags">Tags</label>
                <input type="text" class="form-input" id="tags" name="tags"
                  value="<?php echo htmlspecialchars($post['tags']); ?>"
                  placeholder="php, mysql, database…">
                <div class="form-hint">Separate tags with commas.</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </form>
  </main>
</div>

<div class="toast-container" id="toastContainer"></div>

<script src="app.js"></script>
<script>
// Slug sync
const slugInput   = document.getElementById('slug');
const slugPreview = document.getElementById('slugPreview');

document.getElementById('title').addEventListener('input', function () {
  const slug = this.value.toLowerCase().trim()
    .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
  slugInput.value = slug;
  slugPreview.textContent = slug || '—';
});

slugInput.addEventListener('input', function () {
  slugPreview.textContent = this.value || '—';
});

// SEO score
const metaDesc = document.getElementById('meta_desc');
const seoBar   = document.getElementById('seoBar');
const seoText  = document.getElementById('seoScoreText');

function updateSeo() {
  const len   = metaDesc.value.length;
  const score = Math.min(100, Math.round((len / 160) * 100));
  seoBar.style.width = score + '%';
  seoBar.style.background = score < 40 ? 'var(--danger)' : score < 75 ? 'var(--warning)' : 'var(--success)';
  seoText.textContent = score + '%';
}

metaDesc.addEventListener('input', updateSeo);
updateSeo(); // run on load with existing data
</script>
</body>
</html>
