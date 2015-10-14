## WPE Cache Groups

WPE Cache Groups is a plugin for WordPress. This plugin provides WordPress with access to the WP Engine page cache groups. This is useful for tailoring the front-end experience for devices in a way that works with WP Engine's fast page cache.

### Groups we've found so far

1. normal (the "catch-all" caching group)
2. iphone (all mobile user agents)
3. ipad (I think just Apple iPads)
4. bot (most normal bots that you will ever see (google, bing, facebook, etc))
5. bot-mobile (this works like "if mobile and if bot, cache as bot-mobile")
6. mobile-maybe (new and edge case mobile devices)
7. wptouch-
8. wptouch-default
9. Disqus

## Functions

### get_cache_group()

This function will display the WP Engine cache group used to display the page. **Remember**, the page cache is not used when logged in to WordPress. So you need to be logged out of WordPress for this function to return the group.

    if ( function_exists( 'get_cache_group' ) ) {
        echo get_cache_group();
    }
    
### is_cache_group()

This function will allow you to quickly get a boolean response on whether a certain string matches the current cache group. We find this function is really useful when used in-conjunction with a plugin like [Widget Logic](https://wordpress.org/plugins/widget-logic/)

    is_cache_group( 'iphone' )

## Tests

You can test WPE's page cach results from the command line using curl and egrep. Some examples:

    curl -sIL www.wpengine.com -A "Chrome" | egrep "HTTP|X-Cache"
    HTTP/1.1 200 OK
    X-Cache: HIT: 19
    X-Cache-Group: normal
    
    curl -sIL www.wpengine.com -A "iphone" | egrep "HTTP|X-Cache"
    HTTP/1.1 200 OK
    X-Cache: HIT: 2
    X-Cache-Group: iphone
    
    curl -sIL www.wpengine.com -A "android" | egrep "HTTP|X-Cache"
    HTTP/1.1 200 OK
    X-Cache: HIT: 4
    X-Cache-Group: iphone
    
    curl -sIL www.wpengine.com -A "ipad" | egrep "HTTP|X-Cache"
    HTTP/1.1 200 OK
    X-Cache: MISS
    X-Cache-Group: ipad
    
    curl -sIL www.wpengine.com -A "samsung" | egrep "HTTP|X-Cache"
    X-Cache: HIT: 2
    X-Cache-Group: mobile-maybe
