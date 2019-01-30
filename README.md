# inline-svg-include
PHP function to add an inline SVG to your code

Hopefully the PHPDOC commenting makes this function pretty straightforward.

## Some useful tips for inlining your SVGs:

* Minify your SVGs for significant filesize reductions
* Make sure that your SVG has a `viewbox` attribute as this helps with resizing the SVG using CSS. Syntax is `viewBox="0 0 512 248"` where the values are x, y, width, height.
* Make sure that your container node has a `class` and a `fill` attribute as again, these will help when styling the SVG using CSS

An example (unminified) SVG might look like this:

```xml
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg width="512" height="248" viewBox="0 0 512 248" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
  <g class="colour" fill="#000" >
    <path d="{coordinates}"/>
    <path d="{coordinates}"/>
  </g>
</svg>
```

Example CSS rules for modifying the SVG:

```css
.inline-svg svg{
  width: 40px;
  height: 19px;
}
.inline-svg svg .colour{
  fill: #fff;
}
```
