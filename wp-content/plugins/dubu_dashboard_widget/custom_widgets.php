<?php

$remove_defaults_widgets = array(
    'dashboard_incoming_links' => array(
        'page'    => 'dashboard',
        'context' => 'normal'
    ),
    'dashboard_right_now' => array(
        'page'    => 'dashboard',
        'context' => 'normal'
    ),
    'dashboard_recent_drafts' => array(
        'page'    => 'dashboard',
        'context' => 'side'
    ),
    'dashboard_quick_press' => array(
        'page'    => 'dashboard',
        'context' => 'side'
    ),
    'dashboard_plugins' => array(
        'page'    => 'dashboard',
        'context' => 'normal'
    ),
    'dashboard_primary' => array(
        'page'    => 'dashboard',
        'context' => 'side'
    ),
    'dashboard_secondary' => array(
        'page'    => 'dashboard',
        'context' => 'side'
    ),
    'dashboard_recent_comments' => array(
        'page'    => 'dashboard',
        'context' => 'normal'
    )
);

$custom_dashboard_widgets = array(
    'my-dashboard-widget' => array(
        'title' => 'WORD+PLUS NEWS',
        'callback' => 'dashboardWidgetContent'
    )
);

function dashboardWidgetContent() {
    $user = wp_get_current_user();
    echo "<p>안녕하세요 <strong>" . $user->user_login . "</strong> 님, 워드플러스를 선택해주셔서 감사합니다!</p>";
    echo "다음의 순서로 워드플러스 팩을 설정해주시기 바랍니다.<br><br>";
    ?>

    1. 구글 폰트 설정 (방법:<a href="#" target="_blank">링크</a>)<br>
    2. 사이트 보안강화 설정<br>
    3. 사이트 백업 설<br>

    <br>
    감사합니다.

    <?php

    // 워드플러스 소식 가져오기

}


?>