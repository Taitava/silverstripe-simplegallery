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
			<a href="$URL" data-lightbox="images-{$Up.URLSegment.XML}" title="$Caption.XML">
				<img src="$GalleryThumbnail.URL" alt="$Caption" />
			</a>
			<p>$Caption</p>
		</div>
	<% end_loop %>
</div>