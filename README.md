CSS Ally
====================

DESCRIPTION
---------------------

CSS Ally is a set of PHP scripts that allow you to write clean, valid CSS while
maintaining cross-browser compatibility. This library can automatically perform
any or all of the following functions:

- Add browser prefixes for CSS rules (e.g. "-moz-border-radius")
- Minify and compress your CSS by removing excess white space, comments, and
  (optionally) gzipping the result
- Save the resulting code to a cached file for faster rendering on subsequent
  page loads.
- Use custom variables in your CSS to aid in development

FEATURES
---------------------

### Browser Prefixes

CSS Ally can add browser-prefixed versions of a wide variety of CSS rules. This
gives you the ability to write clean CSS just once without worrying about the
specific syntax of each browser. For browsers that require a prefixed version of
a given CSS rule, the rule is automatically added.

#### Supported CSS Rules

The following CSS rules can be autmatically prefixed by CSS Ally.

<table>
    <thead>
        <tr><th>Rule</th><th>Prefixes</th></tr>
    </thead>
    <tbody>
        <tr><td>@keyframes</td><td>ms, moz, webkit</td></tr>
        <tr><td>animation</td><td>ms, moz, webkit</td></tr>
        <tr><td>animation-delay</td><td>ms, moz, webkit</td></tr>
        <tr><td>animation-direction</td><td>ms, moz, webkit</td></tr>
        <tr><td>animation-duration</td><td>ms, moz, webkit</td></tr>
        <tr><td>animation-iteration-count</td><td>ms, moz, webkit</td></tr>
        <tr><td>animation-name</td><td>ms, moz, webkit</td></tr>
        <tr><td>animation-play-state</td><td>ms, moz, webkit</td></tr>
        <tr><td>animation-timing-function</td><td>ms, moz, webkit</td></tr>
        <tr><td>background-clip</td><td>khtml, moz, webkit</td></tr>
        <tr><td>background-origin</td><td>khtml, moz, webkit</td></tr>
        <tr><td>background-size</td><td>moz, o, webkit</td></tr>
        <tr><td>border-image</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>border-radius</td><td>moz, o, webkit</td></tr>
        <tr><td>border-top-right-radius</td><td>moz, o, webkit</td></tr>
        <tr><td>border-top-left-radius</td><td>moz, o, webkit</td></tr>
        <tr><td>border-bottom-right-radius</td><td>moz, o, webkit</td></tr>
        <tr><td>border-bottom-left-radius</td><td>moz, o, webkit</td></tr>
        <tr><td>box-shadow</td><td>moz, webkit</td></tr>
        <tr><td>column-count</td><td>moz, webkit</td></tr>
        <tr><td>column-gap</td><td>moz, webkit</td></tr>
        <tr><td>column-rule</td><td>moz, webkit</td></tr>
        <tr><td>column-span</td><td>moz, webkit</td></tr>
        <tr><td>column-width</td><td>moz, webkit</td></tr>
        <tr><td>columns</td><td>moz, webkit</td></tr>
        <tr><td>linear-gradient</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>radial-gradient</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>transform</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>transform-origin</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>transition</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>transition-delay</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>transition-duration</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>transition-property</td><td>ms, moz, o, webkit</td></tr>
        <tr><td>transition-timing-function</td><td>ms, moz, o, webkit</td></tr>
    </tbody>
</table>

### Variables

CSS Ally has basic support for variables in your CSS! The primary benefit to
using variables is that changing colors or other aspects of your code can be
done in one place with that change propogating throughout your stylesheets.

The variable syntax for CSS Ally is as follows:

`$[a-zA-Z][-_a-zA-Z0-9]{0,31}`

In other words, a variable is a 1-32 character string that starts with a letter
and contains letters, numbers, hyphens, and underscores.

*Note:* Variables are an optional part of CSS Ally. If you choose not to use
variables in your CSS, then your files can be used with or without this
software.

### Mixins

CSS Ally supports mixins in your CSS! We use the same syntax as SASS, a CSS
pre-processor written Ruby. A simple example mixin would look like this:

```@mixin rounded() {
    border-radius: 5px;
}

div.myclass {
    @include rounded();
}```

Using this in your code would result in the following output:

```div.myclass {
    border-radius: 5px;
}```

Mixins can optionally include parameters, giving you the ability to change the
specifics of the code included in your mixin.

```@mixin rounded($side: top-left, $radius: 10px, $color: green) {
    border-#{$side}-radius: $radius;
    border-color: $color;
}

div.myclass {
    @include rounded();
}

div.myclass2 {
    @include rounded(bottom-right, 2px, blue);
}```

Results in:

```div.myclass {
    border-top-left-radius: 10px;
    border-color: green;
}

div.myclass2 {
    border-bottom-right-radius: 2px;
    border-color: blue;
}```

*Note:* Mixins are an optional part of CSS Ally. If you choose not to use
mixins in your CSS, then your files can be used with or without this
software.

### Cleaning Up Your Code

CSS Ally has more than one way to clean up your code.

#### Remove comments and whitespace

By removing comments and whitespace, you can shrink the total size of your CSS
files by a significant amount. Since browsers don't care about these things,
this should have no effect (other than an increase in speed) on your site.

### Caching

CSS Ally stores a cached copy of the processed CSS file. This way, you can use
the script directly, and it will only rebuild all of your CSS if you have made
changes to one of the files.

A better way to use this script, however, is to generate your processed CSS file
and include that file in your website. The benefit to this is that browsers can
cache your CSS for even faster retrieval. Then, when you need to make changes,
you generate a new compiled CSS file and replace the existing one on your site.

AUTHOR
---------------------

CSS Ally is created and maintained by Bill Parrott <bill@cssally.com>

FUTURE DEVELOPMENT
---------------------

- Complete the implementation of common CSS rules which require vendor-specific
  code to work.
- Add support for targeting specific versions of specific browsers
- ??? (Have a suggestion? [Email me!](mailto:bill@cssally.com "Send me your suggestions"))
- PROFIT!

COMMENTS?
---------------------

Feel free to [email me](mailto:bill@cssally.com) any comments or suggestions you
have, or use Github's [issue tracker](https://github.com/chimericdream/CSS-Ally/issues)
tool.

### Bug Reports

Please use the [issue tracker](https://github.com/chimericdream/CSS-Ally/issues)
built into Github for all bug reports.