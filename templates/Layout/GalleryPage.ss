<div class="row gallery-header">
	<div class="col-xl-12">
		<h1>$Title.XML</h1>
		$Content
		$Form
	</div>
</div>
<div class="row gallery-images">
	<% loop $Images.Sort('SortOrder') %>
		<div class="gallery-image $BootstrapCSSColumnClasses">
			<a href="$URL" data-lightbox="gallery-images-{$Top.URLSegment.XML}" title="$Caption.XML">
				<img src="$GalleryThumbnail.URL" alt="$Caption" class="img-responsive" />
			</a>
			<p style="max-width: {$GalleryThumbnailWidth}px;">$Caption</p>
		</div>
	<% end_loop %>
</div>