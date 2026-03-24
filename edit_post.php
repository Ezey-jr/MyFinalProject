<?php
require_once "Controller/UserController.php";
require_once "Core/Session.php";
require_once "Core/Message.php";
require_once "Core/Helpers.php";
require_once "Core/Auth.php";
require_once "Controller/PostController.php";
// start session everytime
Session::start();
Auth::login_redirect();

$user_type = Auth::user()->user_type == 1 ? "Administrator" : "Moderator";

$total_posts = count(PostController::index());
?>


<!-- dashboard.php -->
<?php
// ── DB connection will go here ──
// $conn = new mysqli("localhost", "user", "password", "blog_db");

// ── Sample data (replace with real DB queries) ──
// $total_posts      = 42;   // SELECT COUNT(*) FROM posts
$published_posts  = 35;   // SELECT COUNT(*) FROM posts WHERE status = 'published'
$draft_posts      = 7;    // SELECT COUNT(*) FROM posts WHERE status = 'draft'
$total_views      = 8410; // SELECT SUM(views) FROM posts

$recent_posts = PostController::latest(4);

$category_emojis = ["Tutorial" => "📘", "Frontend" => "🎨", "Backend" => "⚙️", "Database" => "🗄️", "General" => "📝"];
?>

<?php

$success_msg = "";
$error_msg   = "";

if (!isset($_GET['id']) && empty($_GET['id'])) {
  Helpers::redirect('dashboard.php');
  exit;
}

$id = (int) $_GET['id'];

$post_result = PostController::find($id);
$post_count = (int) $post_result->rowCount();


if ($post_count < 1) {
  Helpers::redirect("dashboard.php");
  exit;
}
$post = $post_result->fetch(PDO::FETCH_ASSOC);
?>

<?php $page_title = "Edit Post" ?>

<?php include_once "views/layouts/header.php" ?>
<?php include_once "views/components/update.php" ?>


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
          <polyline points="15 18 9 12 15 6" />
        </svg>
        Back to Posts
      </a>
      <button class="btn btn-danger" type="button"
        onclick="if(confirm('Delete this post? This cannot be undone.')) window.location.href='delete-post.php?id=<?php echo $id; ?>'">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <polyline points="3 6 5 6 21 6" />
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
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
  <form method="POST" action="edit_post.php?id=<?php echo $id; ?>" id="postForm">
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
                <option value="draft" <?php echo $post['status'] === 'draft'     ? 'selected' : ''; ?>>Draft</option>
                <option value="published" <?php echo $post['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                <option value="archived" <?php echo $post['status'] === 'archived'  ? 'selected' : ''; ?>>Archived</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="category">Category</label>
              <select class="form-select" id="category" name="category">
                <option value="">Select a category</option>
                <?php foreach ($categories as $cat): ?>
                  <option value="<?php echo $cat; ?>" <?php echo $post['category'] === $cat ? 'selected' : ''; ?>>
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
                  <polyline points="20 6 9 17 4 12" />
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


<?php include_once "views/layouts/footer.php" ?>
<script>
  // Slug sync
  const slugInput = document.getElementById('slug');
  const slugPreview = document.getElementById('slugPreview');

  document.getElementById('title').addEventListener('input', function() {
    const slug = this.value.toLowerCase().trim()
      .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    slugInput.value = slug;
    slugPreview.textContent = slug || '—';
  });

  slugInput.addEventListener('input', function() {
    slugPreview.textContent = this.value || '—';
  });

  // SEO score
  const metaDesc = document.getElementById('meta_desc');
  const seoBar = document.getElementById('seoBar');
  const seoText = document.getElementById('seoScoreText');

  function updateSeo() {
    const len = metaDesc.value.length;
    const score = Math.min(100, Math.round((len / 160) * 100));
    seoBar.style.width = score + '%';
    seoBar.style.background = score < 40 ? 'var(--danger)' : score < 75 ? 'var(--warning)' : 'var(--success)';
    seoText.textContent = score + '%';
  }

  metaDesc.addEventListener('input', updateSeo);
  updateSeo(); // run on load with existing data