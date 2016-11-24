<div class="gallery-header $BootstrapRowCSSClass">
	<div class="$BootstrapHeaderCSSClass">
		<h1>$Title.XML</h1>
		$Content
		$Form
	</div>
</div>
<div class="gallery-images $BootstrapRowCSSClass">
	<% loop $Images.Sort('SortOrder') %>
		<div class="gallery-image $BootstrapCSSColumnClasses">
			<a href="$URL" data-lightbox="gallery-images-{$Top.URLSegment.XML}" title="$Caption.XML">
				<img src="$GalleryThumbnail.URL" alt="$Caption" class="img-responsive" />
				<p style="max-width: {$GalleryThumbnailWidth}px;">$Caption</p>
			</a>
		</div>
	<% end_loop %>
</div>