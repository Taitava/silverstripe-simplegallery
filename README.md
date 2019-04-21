# silverstripe-simplegallery

Uses [lightbox 2](http://lokeshdhakar.com/projects/lightbox2/) to create a simple image gallery in SilverStripe.

Sorry, a better readme is still under construction.

This is compatible with SilverStripe 3. Any volunteers for checking the compatibility for SilverStripe 4? :)

## Configuration options

These are the default values:

```YAML
GalleryPage:
  use_bootstrap: true
  use_flexbox: true #Better center images vertically and horizontally. Newest browsers support this in 2016.
  require_bootstrap: false #Set to true if your theme does not include bootstrap already and if you want the module to inject boostrap classes to the GalleryPage. Has no effect if use_boostrap is false.
  allow_image_groups: false #If true, GalleryPages can be divided to multiple sections containing their own sets of images
  allow_direct_images: false #If true, in addition to putting images to groups, they can be directly linked to GalleryPage. If allow_image_groups is false, then this option is always true!
  
GalleryImage:
  thumbnail_width: *your-custom-value in px*
  thumbnail_cols:
    xs: *your custom value from 1 to 12*
    sm: *your custom value from 1 to 12*
    md: *your custom value from 1 to 12*
    lg: *your custom value from 1 to 12*
    xl: *your custom value from 1 to 12*
  thumbnail_height: *your-custom-value in px*
```
