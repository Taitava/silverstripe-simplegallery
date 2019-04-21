<div class="gallery-header $BootstrapRowCSSClass">
	<div class="$BootstrapHeaderCSSClass">
		<h1>$Title.XML</h1>
		$Content
		$Form
	</div>
</div>
<% loop $GroupedImages %>
	<% if $Title %>
		<div class="$BootstrapRowCSSClass">
			<div class="gallery-image-group $BootstrapHeaderCSSClass">
				<h2>$Title</h2>
			</div>
		</div>
	<% end_if %>
	<div class="gallery-images $BootstrapRowCSSClass">
		<% loop $Images %>
			<div class="gallery-image $BootstrapCSSColumnClasses">
				<a href="$URL" data-lightbox="gallery-images-{$Top.URLSegment.XML}" title="$Caption.XML">
					<img src="$GalleryThumbnail.URL" alt="$Caption" class="img-responsive" />
					<p style="max-width: {$GalleryThumbnailWidth}px;">$Caption</p>
				</a>
			</div>
		<% end_loop %>
	</div>
<% end_loop %>
