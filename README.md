# silverstripe-simplegallery

Uses [lightbox 2](http://lokeshdhakar.com/projects/lightbox2/) to create a simple image gallery in SilverStripe.

Sorry, a better readme is still under construction.

## Configuration options

These are the default values:

```YAML
GalleryPage:
  require_bootstrap: false #Set to true if your theme does not include bootstrap already.
  
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