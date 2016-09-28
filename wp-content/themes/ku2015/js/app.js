var program_endpoint = "https://studentersamfundet.no/api/events/get_upcoming/";
var concepts = "akademisk-vorspiel,onsdagsdebatten,boktorsdag,kulturutvalget-akademika";

function get_event_type_class(post) {
    if (post.taxonomy_event_type.length >= 1) {
        return 'event-concept-' + post.taxonomy_event_type[0].slug;
    }
    return '';
}

function get_event_type_name(post) {
    if (post.taxonomy_event_type.length >= 1) {
        return post.taxonomy_event_type[0].title;
    }
    return '';
}

function format_single_post(post) {
    var html = '';
    html += '<span class="event-starttime">'+ moment.unix(post.custom_fields._neuf_events_starttime).utc().format("D. MMMM YYYY, HH:mm") +'</span>';
    html += '<a href="'+ post.url +'">';
    if (post.thumbnail_images != undefined) {
        html += '<img src="'+ post.thumbnail_images["newsletter-half"].url +'" />';
    } else {
        //var stylesheet_dir = jQuery("meta[name=x-stylesheet-directory]").attr('content');
        //html += '<img src="'+ stylesheet_dir +'/img/ku-logo3.png" />';
    }
    html += '</a>'
    html += '<span class="event-concept-name">' + get_event_type_name(post) + '</span>';
    html += '<a href="'+ post.url +'">';
    html += '<h3 class="event-title">'+ post.title +'</h3></a>';
    html += '<span class="event-excerpt">'+ post.excerpt +'</span>';
    return html;
}

function format_posts_for_program(posts) {
    if (posts.length === 0) {
        return '<p class="no-events fadein">Nytt program kommer ved starten av neste semester!</p>';
    }

    var html = '';
    html += '<div class="program-list fadein">';
    for (var i=0; i< posts.length; i++) {
        var post = posts[i];
        html += '<div class="event '+ get_event_type_class(post) +'">'+ format_single_post(post) +'</div>';
    }

    return html;
}

function format_next_event(posts) {
    if (posts.length === 0) {
        return '<p class="no-events fadein">Finner ingen fremtidige arrangementer.</p>';
    }

    var post = posts[0];
    var html = '';
    html += '<a href="'+ post.url +'">';
    html += post.title + ' ';
    html += '('+ moment.unix(post.custom_fields._neuf_events_starttime).utc().format("D. MMMM YYYY, HH:mm") +')';
    html += '</a>';
    return html;
}

function format_posts_for_front_page(posts) {
    var html = '';
    for (var i=0; i< posts.length; i++) {
	console.log(posts.length);
        var post = posts[i];
        html += '<div class="event grid fourth '+ get_event_type_class(post) +'">' + format_single_post(post) + '</div>';
    }
    return html;
}

function fetch_next_events_by_type(event_type, num, formatter, element) {
    var query_params = {
        event_type: event_type,
        posts_per_page: num,
    };

    var callback = function(data) {
        if (data && data.count && data.count > 0 && data.events) {
            jQuery(element).html(formatter(data.events));
        } else {
            if (num == 4) {
                jQuery(element).html('');
            } else {
                jQuery(element).html('Ukjent');
            }
        }
    };

    jQuery.getJSON(program_endpoint + "?callback=?", query_params, callback);
}

function load_instafeed() {
    var feed = new Instafeed({
        target: 'instagram',
        get: 'user',
        userId: 612351633, // @kulturutvalget
        accessToken: '612351633.467ede5.0f82762612e148ee928015033a8886df',
        clientId: '9e79c72477874cda8027016cd201f5de',
        resolution: 'low_resolution',
        limit: 8,
        template: '<figure><a href="{{link}}" target="_blank"><img src="{{image}}" /></a></figure>'
    });
    feed.run();
}

jQuery(document).ready(function() {
    moment.locale("nb");
    var $ = jQuery;

    /* Are we on the program page? */
    if ($('.program-upcoming .program-list-wrap').length) {
        $.getJSON(
            program_endpoint + "?callback=?",
            { event_type: concepts },
            function(data) {
                if (data && data.events) {
                    //var html = format_posts(data.events.slice(0, 4));
                    var html = format_posts_for_program(data.events)
                    $(".program-upcoming .program-list-wrap").html(html);
                }
            }
        );
    }

    /* Are we on the front page? */
    if ($('.home').length) {
        load_instafeed();

        fetch_next_events_by_type(concepts, 4, format_posts_for_front_page, '.home #next-three-events');
        fetch_next_events_by_type('akademisk-vorspiel', 1, format_next_event,'.home #akademisk-vorspiel .next-event');
        fetch_next_events_by_type('onsdagsdebatten', 1, format_next_event, '.home #onsdagsdebatten .next-event');
        fetch_next_events_by_type('boktorsdag', 1, format_next_event, '.home #boktorsdag .next-event');
    }

    /* Menu toggle */
    /*$("#menu [data-toggle-menu]").on('click', function(e) {
        e.preventDefault();
        // add open css class
        var menu = $("#menu .main-menu");
        menu.toggleClass("visible");
    });*/

});
