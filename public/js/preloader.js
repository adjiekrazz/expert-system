setTimeout(() => {
    $preloader = $('.preloader');

    if($preloader) {
        $preloader.css('height', 0);
        setTimeout(() => {
            $preloader.children().hide();
        }, 200);
    }
}, 200)