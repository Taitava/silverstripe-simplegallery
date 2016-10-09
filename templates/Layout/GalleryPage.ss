<div class="gallery-images">
	<h1>$Title</h1>
	$Content
	<% loop $Images.Sort('SortOrder') %>
		<div class="gallery-image" style="height: {$GalleryThumbnailPlusCaptionHeight}px; min-height: {$GalleryThumbnailPlusCaptionHeight}px; max-height: {$GalleryThumbnailHeight}px;">
			<a href="$URL" data-lightbox="images-{$Up.Title}" title="$Caption"><img src="$GalleryThumbnail.URL" alt="$Caption" /></a>
			<p style="max-width: {$GalleryThumbnail.Width}px;">$Caption</p>
		</div>
	<% end_loop %>
	<div class="gallery-end"></div>
	$Form
</div>