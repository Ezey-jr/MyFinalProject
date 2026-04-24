
<?php

include_once "views/components/inc_add_post.php";

$page_title = "Add New Post";

$total_posts = count(PostController::index()) ;
// $user_type = Auth::user()->user_type == 1 ? "Administrator" : "Moderator"; 

include_once "views/layouts/header.php";
?>

  <main class="page-content">
    <div class="page-header">
      <div>
        <div class="page-heading">Add New Post</div>
        <div class="page-sub">Fill in the details below to create a new blog post</div>
      </div>
      <a href="posts.php" class="btn btn-secondary">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
        Back to Posts
      </a>
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
    <form method="POST" action="" id="postForm"  enctype="multipart/form-data">
      <div class="form-grid">

        <!-- Left: Main content -->
        <div style="display:flex; flex-direction:column; gap:1.25rem;">

          <!-- Title & Slug -->
          <div class="form-card">
            <div class="form-card-header">Post Content</div>
            <div class="form-card-body">

              <div class="form-group">
                <label class="form-label" for="title">Post Title <span class="req">*</span></label>
                <input type="text" class="form-input" id="title" name="title"
                  placeholder="Enter an engaging post title…"
                  value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" >
              </div>

              <div class="form-group">
                <label class="form-label" for="slug">Slug</label>
                <input type="text" class="form-input" id="slug" name="slug"
                  placeholder="post-url-slug"
                  value="<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>">
                <div class="slug-preview">Preview: yourblog.com/posts/<span id="slugPreview">—</span></div>
              </div>

              <div class="form-group">
                <label class="form-label" for="excerpt">Excerpt / Summary</label>
                <textarea class="form-textarea" id="excerpt" name="excerpt"
                  rows="3" style="min-height:5rem;"
                  placeholder="A short summary shown on listing pages…"><?php echo htmlspecialchars($_POST['excerpt'] ?? ''); ?></textarea>
                <div class="form-hint">Keep it under 160 characters for best SEO results.</div>
              </div>

              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="body">Content <span class="req">*</span></label>
                <textarea class="form-textarea" id="body" name="body"
                  placeholder="Write your post content here…" ><?php echo htmlspecialchars($_POST['body'] ?? ''); ?></textarea>
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
                  rows="3" style="min-height:5rem;"
                  placeholder="Describe this post for search engines…"><?php echo htmlspecialchars($_POST['meta_desc'] ?? ''); ?></textarea>
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

        <!-- Right: Sidebar settings -->
        <div style="display:flex; flex-direction:column; gap:1.25rem;">

          <!-- Publish box -->
          <div class="form-card">
            <div class="form-card-header">Publish</div>
            <div class="form-card-body">
              <div class="form-group">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status">
                  <option value="draft"     <?php echo (($_POST['status'] ?? '') === 'draft')     ? 'selected' : ''; ?>>Draft</option>
                  <option value="published" <?php echo (($_POST['status'] ?? '') === 'published') ? 'selected' : ''; ?>>Published</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label" for="category">Category</label>
                <select class="form-select" id="category" name="category">
                  <option value="">Select a category</option>
                  <?php foreach ($categories as $cat): ?>
                  <option value="<?php echo $cat; ?>"
                    <?php echo (($_POST['category'] ?? '') === $cat) ? 'selected' : ''; ?>>
                    <?php echo $cat; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-actions">
                <button type="submit" name="status_submit" value="draft" class="btn btn-secondary">
                  Save Draft
                </button>
                <button type="submit" name="status_submit" value="published" class="btn btn-primary">
                  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 2L11 13"/><path d="M22 2L15 22l-4-9-9-4 20-7z"/>
                  </svg>
                  Publish
                </button>
              </div>
            </div>
          </div>

          <!-- Featured Image -->
          <div class="form-card">
            <div class="form-card-header">Featured Image</div>
            <div class="form-card-body">
              <label for="featured_image">
                <div class="image-upload-zone" id="uploadZone">
                  <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                  </svg>
                  <p>Click to upload image</p>
                  <small>PNG, JPG, WebP — max 2MB</small>
                </div>
              </label>
              <input type="file" id="featured_image" name="featured_image"
                accept="image/*" style="display:none;" onchange="previewImage(this)">
              <div id="imagePreview" style="display:none; margin-top:.75rem;">
                <img id="previewImg" src="" alt="Preview"
                  style="width:100%; border-radius:var(--radius-sm); max-height:10rem; object-fit:cover;">
                <button type="button" onclick="clearImage()"
                  style="margin-top:.4rem; font-size:.75rem; color:var(--danger); background:none; border:none; cursor:pointer;">
                  Remove image
                </button>
              </div>
            </div>
          </div>

          <!-- Tags -->
          <div class="form-card">
            <div class="form-card-header">Tags</div>
            <div class="form-card-body">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="tags">Tags</label>
                <input type="text" class="form-input" id="tags" name="tags"
                  placeholder="php, mysql, database…"
                  value="<?php echo htmlspecialchars($_POST['tags'] ?? ''); ?>">
                <div class="form-hint">Separate tags with commas.</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </form>
  </main>
</div>

<?php require_once "views/layouts/footer.php" ?>
<script>
// Auto-generate slug from title
const titleInput   = document.getElementById('title');
const slugInput    = document.getElementById('slug');
const slugPreview  = document.getElementById('slugPreview');

function toSlug(str) {
  return str.toLowerCase().trim()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-');
}

titleInput.addEventListener('input', function () {
  const slug = toSlug(this.value);
  slugInput.value = slug;
  slugPreview.textContent = slug || '—';
});

slugInput.addEventListener('input', function () {
  slugPreview.textContent = this.value || '—';
});

// SEO score from meta description length
const metaDesc = document.getElementById('meta_desc');
const seoBar   = document.getElementById('seoBar');
const seoText  = document.getElementById('seoScoreText');

metaDesc.addEventListener('input', function () {
  const len   = this.value.length;
  const score = Math.min(100, Math.round((len / 160) * 100));
  seoBar.style.width = score + '%';
  seoBar.style.background = score < 40 ? 'var(--danger)' : score < 75 ? 'var(--warning)' : 'var(--success)';
  seoText.textContent = score + '%';
});

// Image preview
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById('previewImg').src = e.target.result;
      document.getElementById('imagePreview').style.display = 'block';
      document.getElementById('uploadZone').style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}


function clearImage() {
  document.getElementById('featured_image').value = '';
  document.getElementById('imagePreview').style.display = 'none';
  document.getElementById('uploadZone').style.display = 'block';
}

// Submit feedback
document.getElementById('postForm').addEventListener('submit', function () {
  showToast('Saving post…', 'info');
});
</script>
