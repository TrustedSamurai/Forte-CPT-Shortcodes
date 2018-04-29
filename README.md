# Forte CPT Shortcodes
#
# Decided to use GitHub to manage changes to this plugin.
#
# Its likely I'll continue to grow this plugin and it may fork off to different versions for different purposes.  I'd also like to not totally destroy my work with the odd glitch!  version control should help with this.

So far the plugin does the following:
30/4/2018
This will display a list of CPT Titles sorted by the numeric field specified in the
 shortcode.  It will also restrict output to just the taxonomy specified.

 arguments are:
 	posttypeslug	- what is the slug of the main posttype?
 	taxonomyslug	- slug of taxonomy stated in $args 'taxonomy' array below
	numericsortslug - where a numeric sort is required specify the slug of the field here
	filterdate 		- specify the date slug if you want to hide content earlier than today()

