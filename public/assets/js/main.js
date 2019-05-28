jQuery(document).ready(function ($) {
    $(".selectpicker").selectpicker({
        style: "btn-select",
        size: 4
    });
});
$("#carousel-slider").carousel();
$('a[data-slide="prev"]').click(function () {
    $("#carousel-slider").carousel("prev");
});
$('a[data-slide="next"]').click(function () {
    $("#carousel-slider").carousel("next");
});
jQuery(document).ready(function ($) {
    $(".counter").counterUp({
        delay: 1,
        time: 800
    });
});
var wow = new WOW({
    mobile: false
});
wow.init();
$(window).load(function () {
    "use strict";
    $("#loader").fadeOut();
});
$(document).ready(function () {
    jQuery(".tp-banner")
        .show()
        .revolution({
            dottedOverlay: "none",
            delay: 9000,
            startwidth: 1170,
            startheight: 540,
            hideThumbs: 200,
            thumbWidth: 100,
            thumbHeight: 50,
            thumbAmount: 5,
            navigationType: "bullet",
            navigationArrows: "solo",
            navigationStyle: "preview3",
            touchenabled: "on",
            onHoverStop: "on",
            swipe_velocity: 0.7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: false,
            parallax: "mouse",
            parallaxBgFreeze: "on",
            parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],
            keyboardNavigation: "off",
            navigationHAlign: "center",
            navigationVAlign: "bottom",
            navigationHOffset: 0,
            navigationVOffset: 20,
            soloArrowLeftHalign: "left",
            soloArrowLeftValign: "center",
            soloArrowLeftHOffset: 20,
            soloArrowLeftVOffset: 0,
            soloArrowRightHalign: "right",
            soloArrowRightValign: "center",
            soloArrowRightHOffset: 20,
            soloArrowRightVOffset: 0,
            shadow: 0,
            fullWidth: "on",
            fullScreen: "off",
            spinner: "spinner1",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            forceFullWidth: "off",
            hideThumbsOnMobile: "off",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "off",
            hideArrowsOnMobile: "off",
            hideThumbsUnderResolution: 0,
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            startWithSlide: 0,
            fullScreenOffsetContainer: ""
        });
});
$("#new-products").owlCarousel({
    navigation: true,
    pagination: true,
    slideSpeed: 1000,
    stopOnHover: true,
    autoPlay: true,
    items: 5,
    itemsDesktopSmall: [1024, 3],
    itemsTablet: [600, 1],
    itemsMobile: [479, 1]
});
$("#best-products").owlCarousel({
    navigation: true,
    pagination: true,
    slideSpeed: 1000,
    stopOnHover: true,
    autoPlay: true,
    items: 5,
    itemsDesktopSmall: [1024, 3],
    itemsTablet: [600, 1],
    itemsMobile: [479, 1]
});
$(".touch-slider").owlCarousel({
    navigation: false,
    pagination: true,
    slideSpeed: 1000,
    stopOnHover: true,
    autoPlay: true,
    items: 1,
    itemsDesktopSmall: [1024, 1],
    itemsTablet: [600, 1],
    itemsMobile: [479, 1]
});
$(".touch-slider")
    .find(".owl-prev")
    .html('<i class="fa fa-angle-left"></i>');
$(".touch-slider")
    .find(".owl-next")
    .html('<i class="fa fa-angle-right"></i>');
$("#new-products")
    .find(".owl-prev")
    .html('<i class="fa fa-angle-left"></i>');
$("#new-products")
    .find(".owl-next")
    .html('<i class="fa fa-angle-right"></i>');
$("#best-products")
    .find(".owl-prev")
    .html('<i class="fa fa-angle-left"></i>');
$("#best-products")
    .find(".owl-next")
    .html('<i class="fa fa-angle-right"></i>');
var owl;
$(document).ready(function () {
    owl = $("#owl-demo");
    owl.owlCarousel({
        navigation: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        afterInit: afterOWLinit,
        afterUpdate: afterOWLinit,
        autoPlay: 3000,
        stopOnHover: true
    });

    function afterOWLinit() {
        $(".owl-controls .owl-page").append('<a class="item-link" />');
        var pafinatorsLink = $(".owl-controls .item-link");
        $.each(this.owl.userItems, function (i) {
            $(pafinatorsLink[i])
                .css({
                    background:
                        "url(" +
                        $(this)
                            .find("img")
                            .attr("src") +
                        ") center center no-repeat",
                    "-webkit-background-size": "cover",
                    "-moz-background-size": "cover",
                    "-o-background-size": "cover",
                    "background-size": "cover"
                })
                .click(function () {
                    owl.trigger("owl.goTo", i);
                });
        });
        $(".owl-pagination").prepend('<a href="#prev" class="prev-owl"/>');
        $(".owl-pagination").append('<a href="#next" class="next-owl"/>');
        $(".next-owl").click(function () {
            owl.trigger("owl.next");
        });
        $(".prev-owl").click(function () {
            owl.trigger("owl.prev");
        });
    }
});
var offset = 200;
var duration = 500;
$(window).scroll(function () {
    if ($(this).scrollTop() > offset) {
        $(".back-to-top").fadeIn(400);
    } else {
        $(".back-to-top").fadeOut(400);
    }
});
$(".back-to-top").click(function (event) {
    event.preventDefault();
    $("html, body").animate(
        {
            scrollTop: 0
        },
        600
    );
    return false;
});
$(".list,switchToGrid").click(function (e) {
    e.preventDefault();
    $(".grid").removeClass("active");
    $(".list").addClass("active");
    $(".item-list").addClass("make-list");
    $(".item-list").removeClass("make-grid");
    $(".item-list").removeClass("make-compact");
    $(".item-list .add-desc-box").removeClass("col-sm-9");
    $(".item-list .add-desc-box").addClass("col-sm-7");
});
$(".grid").click(function (e) {
    e.preventDefault();
    $(".list").removeClass("active");
    $(this).addClass("active");
    $(".item-list").addClass("make-grid");
    $(".item-list").removeClass("make-list");
    $(".item-list").removeClass("make-compact");
    $(".item-list .add-desc-box").removeClass("col-sm-9");
    $(".item-list .add-desc-box").addClass("col-sm-7");
});

// check 404 page
var pageTitle = $("title").text();
if (pageTitle.includes('404 Error')) {
    $('#top-nav-area').hide();
}

// custom for header cart item
$(".cart-item-detail").on("click", function () {
    window.location.replace("/courses/" + $(this).data("id"));
});

// custom for header notification
$("#notification-area").on("click", ".notification-detail", function () {
    $("#notification-count").text(
        parseInt($("#notification-count").text()) - 1
    );
    if ($(this).data("status") == 0) {
        $(this).css({
            background: ""
        });
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        // Comment in course
        if ($(this).data('lecturecommentcourseid') == undefined) {
            console.log(123);
            $.ajax({
                url: "/notifications/" + $(this).data("id") + "/changeStatus",
                type: "post",
                data: {
                    courseId: $(this).data("course"),
                    commentId: $(this).data("comment")
                },
                success: function (responseData) {
                    if (responseData.parentCommentId == null) {
                        window.location.replace(
                            "/courses/" +
                            responseData.courseId +
                            "#li-comment-" +
                            responseData.commentId
                        );
                    } else {
                        window.location.replace(
                            "/courses/" +
                            responseData.courseId +
                            "#li-comment-" +
                            responseData.parentCommentId
                        );
                    }
                }
            });
            // Comment in lecture
        } else {
            $.ajax({
                url: "/notifications/" + $(this).data("id") + "/changeStatus",
                type: "post",
                data: {
                    lectureId: $(this).data("lecturecommentlectureid"),
                    commentId: $(this).data("comment")
                },
                success: function (responseData) {
                    if (responseData.parentCommentId == null) {
                        window.location.replace(
                            "/courses/" +
                            responseData.lectureInCourseId +
                            "/lectures/" +
                            responseData.lectureId
                            + "/#li-comment-" +
                            responseData.commentId
                        );
                    } else {
                        window.location.replace(
                            "/courses/" +
                            responseData.lectureInCourseId +
                            "/lectures/" +
                            responseData.lectureId
                            + "/#li-comment-" +
                            responseData.parentCommentId
                        );
                    }
                }
            });
        }
    } else if ($(this).data("status") == 1) {
        var parentCommentId = $(this).data("parent");
        var lectureCommentCourseId = $(this).data("lectureCommentCourseId");
        if (!parentCommentId) {
            if ($(this).data('lecturecommentcourseid') != 'undefined') {
                window.location.replace(
                    "/courses/" +
                    $(this).data('lecturecommentcourseid') +
                    "/lectures/" +
                    $(this).data('lecturecommentlectureid')
                    + "/#li-comment-" +
                    $(this).data("comment")
                );
            } else {
                window.location.replace(
                    "/courses/" +
                    $(this).data("course") +
                    "#li-comment-" +
                    $(this).data("comment")
                );
            }
        } else {
            if ($(this).data('lecturecommentcourseid') != 'undefined') {
                window.location.replace(
                    "/courses/" +
                    $(this).data('lecturecommentcourseid') +
                    "/lectures/" +
                    $(this).data('lecturecommentlectureid')
                    + "/#li-comment-" +
                    parentCommentId
                );
            } else {
                window.location.replace(
                    "/courses/" +
                    $(this).data("course") +
                    "#li-comment-" +
                    parentCommentId
                );
            }
        }
    }
});

// Timer notification
var myTimer;

// custom notification
// Thay giá trị PUSHER_APP_KEY vào chỗ xxx này nhé
var pusher = new Pusher("f2b354d9cdae3999c31d", {
    encrypted: true,
    cluster: "ap1"
});

// Subscribe to the channel we specified in our Laravel Event
var notificationChannel = pusher.subscribe("notification");

// Bind a function to a Event (the full Laravel class)
notificationChannel.bind(
    "App\\Events\\GetNotificationFromPusherEvent",
    function (data) {
        var currentUserId = $("#current-user").val();
        var commentedUserIdList = data.commentedUserList;
        var commentedUserIdArray = Object.values(commentedUserIdList);
        var resultCheck = checkUser(currentUserId, commentedUserIdArray);
        if (resultCheck == false) {
            return false;
        }

        $("#notification-count").text(
            parseInt($("#notification-count").text()) + 1
        );
        var notificationList = $("#notification-list");
        var createdComment = data.createdComment;

        var statusStyle = "background: #CECEF6";
        var parentComment =
            "{{ AppModelsComment::findOrFail(" +
            createdComment.comment_id +
            ")->parent_comment }}";

        var userAvatar = data.userAvatar;
        userAvatar = userAvatar.replace(
            "images/",
            "http://127.0.0.1:8000/images/"
        );

        var commentContent = "";
        if (data.commentContent.length >= 24) {
            commentContent = data.commentContent.substr(0, 30) + "...";
        } else {
            commentContent = data.commentContent;
        }

        var createNotificationIdList = data.createNotificationIdList;
        var notificationId = getNotificationId(
            currentUserId,
            createNotificationIdList
        );

        var newNotificationHtml =
            '<li class="notification-detail" data-id="' +
            notificationId +
            '" data-status="' +
            "0" +
            '" style="cursor: pointer; ' +
            statusStyle +
            '" data-type="' +
            createdComment.type +
            '" data-course="' +
            createdComment.course_id +
            '" data-comment="' +
            createdComment.id +
            '" data-parent="' +
            parentComment +
            '" data-lectureCommentCourseId="'
            + data.dataLectureCommentCourseId
            + '" data-lectureCommentLectureId="'
            + createdComment.lecture_id
            + '"> <span class="item"> <span class="item-left"><img src="' +
            userAvatar +
            '"style="height: 45px; width: 45px" alt=""/><span class="item-info"><span>' +
            commentContent +
            '</span> <span class="diff-time" id="diff-time-' +
            notificationId +
            '" data-time="' +
            new Date().getTime() / 1000 +
            '">' +
            data.diffTime +
            "</span> </span> </span> </span> </li>";
        var newDockHtml = '<li class="divider"></li><li class="text-center"><a href="http://127.0.0.1:8000/notifications/index"><h4> See all notifications </h4></a></li>';
        if ($('#none-dock').length) {
            $('#none-dock').hide();
            notificationList.prepend(newDockHtml);
        }
        if ($("#notification-list li").length >= 10) {
            $("#notification-list li:nth-child(8)").hide();
        }
        notificationList.prepend(newNotificationHtml).ready(function () {
            clearInterval(myTimer);
            myTimer = setInterval(updateTime, 3000);
        });
        if (data.dataLectureCommentCourseId != undefined) {
            $.notify({
                // options
                message: data.commentContent,
                url: '/courses/' + data.dataLectureCommentCourseId + '/lectures/' + createdComment.lecture_id + '#li-comment-' + createdComment.id,
            }, {
                // settings
                type: 'info',
                placement: {
                    from: "bottom",
                    align: "left"
                }
            });
        } else if (createdComment.course_id != undefined) {
            $.notify({
                // options
                message: data.commentContent,
                url: '/courses/' + createdComment.course_id + '#li-comment-' + createdComment.id,
            }, {
                // settings
                type: 'info',
                placement: {
                    from: "bottom",
                    align: "left"
                }
            });
        }
    }
);

myTimer = setInterval(updateTime, 10000);

function updateTime() {
    $(".diff-time").each(function (i, element) {
        var beforeTime = $(this).data("time");
        var elementId = $(this).attr("id");
        updateDiffTime(beforeTime, elementId);
    });
}

function updateDiffTime(time, idElement) {
    $("#" + idElement).text(getHumanTime(time));
}

function getHumanTime(date) {
    // Make a fuzzy time
    var delta = Math.round((new Date().getTime() - date * 1000) / 1000);
    var minute = 60,
        hour = minute * 60,
        day = hour * 24,
        week = day * 7,
        month = week * 4,
        year = month * 12;

    var fuzzy;

    if (delta < 30) {
        fuzzy = "just then";
    } else if (delta < minute) {
        fuzzy = delta + " seconds ago";
    } else if (delta < 2 * minute) {
        fuzzy = "a minute ago.";
    } else if (delta < hour) {
        fuzzy = Math.floor(delta / minute) + " minutes ago";
    } else if (Math.floor(delta / hour) == 1) {
        fuzzy = "an hour ago";
    } else if (delta < day) {
        fuzzy = Math.floor(delta / hour) + " hours ago";
    } else if (delta < day * 2) {
        fuzzy = "yesterday";
    } else if (Math.floor(delta / day) == 1) {
        fuzzy = "a day ago";
    } else if (delta < week) {
        fuzzy = Math.floor(delta / day) + " days ago";
    } else if (Math.floor(delta / week) == 1) {
        fuzzy = "1 week ago";
    } else if (delta < month) {
        fuzzy = Math.floor(delta / week) + " weeks ago";
    } else if (Math.floor(delta / month) == 1) {
        fuzzy = "a month ago";
    } else if (delta < year) {
        fuzzy = Math.floor(delta / month) + " months ago";
    } else if (Math.floor(delta / year) == 1) {
        fuzzy = "a year ago";
    } else {
        fuzzy = Math.floor(delta / year) + " years ago";
    }

    return fuzzy;
}

function checkUser(currentUserId, commentedUserIdArray) {
    for (const userId of commentedUserIdArray) {
        if (currentUserId == userId) {
            return true;
        }
    }

    return false;
}

function getNotificationId(currentUserId, createNotificationIdArray) {
    for (var userId in createNotificationIdArray) {
        if (currentUserId == userId) {
            return createNotificationIdArray[userId];
        }
    }

    return false;
}

$(function () {
    $("#open-chat-with-admin").click(function (event) {
        event.preventDefault();
        $('#qnimate').addClass('popup-box-on');
        $(this).fadeOut(200);
    });

    $("#removeClass").click(function () {
        $('#qnimate').removeClass('popup-box-on');
        $("#open-chat-with-admin").fadeIn(300);
    });
})

$(document).on('keypress', function (e) {
    if (e.which == 13) {
        var senderId = $('#sender-id').val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            url: "/conversations/store",
            type: "post",
            data: {
                user_sender_id: senderId,
                content: $('#status_message').val(),
            },
            success: function (responseData) {
                // var response = jQuery.parseJSON(responseData);
                // var createdConversation = response.createdConversation;
                // var createdMessage = response.message;
                // var sender = response.sender;
                // var senderAvatar = sender.avatar;
                // var createdTime = response.created_time;
                // senderAvatar = senderAvatar.replace(
                //     "images/",
                //     "http://127.0.0.1:8000/images/"
                // );
                $('#status_message').val('');
                // var conversationList = $('#conversation-list');
                // var newConversationHtml = '            <!-- Message. Default to the left -->\n' +
                //     '            <div class="direct-chat-msg doted-border">\n' +
                //     '                <div class="direct-chat-info clearfix">\n' +
                //     '                    <span class="direct-chat-name pull-left">'
                //     + sender.name +
                //     '</span>\n' +
                //     '                </div>\n' +
                //     '                <!-- /.direct-chat-info -->\n' +
                //     '                <img alt="iamgurdeeposahan"\n' +
                //     '                     src="' +
                //     senderAvatar +
                //     '"\n' +
                //     '                     class="direct-chat-img"><!-- /.direct-chat-img -->\n' +
                //     '                <div class="direct-chat-text">\n' +
                //     createdMessage.content +
                //     '                </div>\n' +
                //     '                <div class="direct-chat-info clearfix">\n' +
                //     '                    <span class="direct-chat-timestamp pull-right">' +
                //     createdTime +
                //     '</span>\n' +
                //     '                </div>';
                // conversationList.append(newConversationHtml)
            }
        });
    }
});

// Conversation area
document.getElementById('popup-messages').scrollTop = 9999999;
// custom notification
var pusher = new Pusher("f2b354d9cdae3999c31d", {
    encrypted: true,
    cluster: "ap1"
});

var conversationMessageChannel = pusher.subscribe("conversation-message");

conversationMessageChannel.bind(
    "App\\Events\\GetConversationMessageFromPusherEvent",
    function (data) {
        var currentUserId = $("#current-user").val();
        if (data.toUser.id == currentUserId) {
            var userAvatar = data.fromUser.avatar;
            userAvatar = userAvatar.replace(
                "images/",
                "http://127.0.0.1:8000/images/"
            );
            var newMessageHtml = '<div class="direct-chat-msg doted-border">\n' +
                '                        <div class="direct-chat-info clearfix">\n' +
                '                            <span class="direct-chat-name pull-left">' + data.fromUser.name +
                '</span>\n' +
                '                        </div>\n' +
                '                        <!-- /.direct-chat-info -->\n' +
                '                        <img alt="' + data.fromUser.name +
                '"\n' +
                '                             src="' + userAvatar +
                '"\n' +
                '                             class="direct-chat-img"><!-- /.direct-chat-img -->\n' +
                '                        <div class="direct-chat-text">\n' + data.message.content +
                '                            \n' +
                '                        </div>\n' +
                '                        <div class="direct-chat-info clearfix">\n' +
                '                            <span class="direct-chat-timestamp pull-right">' + data.createdTime +
                '</span>\n' +
                '                        </div>\n' +
                '                    </div>';
            var conversationList = $('#conversation-list');
            conversationList.append(newMessageHtml);
            document.getElementById('popup-messages').scrollTop = 9999999;
        }
    }
);

