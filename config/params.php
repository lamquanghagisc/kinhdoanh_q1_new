<?php

return [
    'adminEmail' => 'truongan361987@gmail.com',
    'senderEmail' => 'noreply@hcmgispointcloud.com',
    'senderName' => 'HCMGIS cấp Quận/Huyện',
    'jwt' => [
        'issuer' => 'gisdashboard',  //name of your project (for information only)
        'audience' => 'hcmgis.vn',  //description of the audience, eg. the website using the authentication (for info only)
        'id' => 'o60lq8tkQdSpe0YVVgspsSNPn',  //a unique identifier for the JWT, typically a random string
        'expire' => YII_ENV_DEV ? 100000 : 300,  //the short-lived JWT token is here set to expire after 5 min.
    ],
    'siteName' => 'HCMGIS Dashboard',
    'adminSidebar' => [
        [
            'name' => 'Quản trị hệ thống',
            'items' => [
                [
                    'name' => 'Quản lý người dùng',
                    'icon' => 'fa fa-user-circle',
                    'url' => '/cms/auth-user'
                ],
                [
                    'name' => 'Quản lý nhóm quyền',
                    'icon' => 'fa fa-users',
                    'url' => '/auth/auth-group'
                ],
                [
                    'name' => 'Quản lý quyền truy cập',
                    'icon' => 'fa fa-key',
                    'url' => '/auth/auth-role'
                ],
                [
                    'name' => 'Quản lý hoạt động',
                    'icon' => 'fa fa-cog',
                    'url' => '/auth/auth-action'
                ],
            ]
        ]
    ],
    'sidebarContent' => [
        [
            'name' => 'Hộ kinh doanh',
            'url' => 'quanly/hokinhdoanh/index',
            'icon' => 'fa fa-warehouse',
        ],
        // [
        //     'name' => 'CS Chăn nuôi',
        //     'url' => 'quanly/coso-channuoi/index',
        //     'icon' => 'fa fa-piggy-bank',
        // ],
        // [
        //     'name' => 'CS Nuôi chim yến',
        //     'url' => 'quanly/coso-chimyen/index',
        //     'icon' => 'fa fa-dove',
        // ],
        // [
        //     'name' => 'CS Giết mổ',
        //     'url' => 'quanly/coso-gietmo/index',
        //     'icon' => 'fa fa-khanda',
        // ],
        // [
        //     'name' => 'CS Sản xuất',
        //     'url' => 'quanly/coso-sanxuat/index',
        //     'icon' => 'fa fa-warehouse',
        // ],
        // [
        //     'name' => 'CS Hành nghề thú y',
        //     'url' => 'quanly/coso-hanhnghe/index',
        //     'icon' => 'fa fa-hospital-user',
        // ],
        // [
        //     'name' => 'CS Kinh doanh thức ăn',
        //     'url' => 'quanly/coso-kinhdoanhthucan/index',
        //     'icon' => 'fa fa-carrot',
        // ],
        // [
        //     'name' => 'CS Kinh doanh thuốc',
        //     'url' => 'quanly/coso-kinhdoanhthuoc/index',
        //     'icon' => 'fa fa-pills',
        // ],
        // [
        //     'name' => 'CS Thu gom sữa tươi',
        //     'url' => 'quanly/coso-thugomsuatuoi/index',
        //     'icon' => 'fa fa-wine-bottle',
        // ],
        // [
        //     'name' => 'Trạm kiểm dịch',
        //     'url' => 'quanly/tramkiemdich/index',
        //     'icon' => 'fa fa-person-booth',
        // ],
        // [
        //     'name' => 'HTX Chăn nuôi',
        //     'url' => 'quanly/htx-channuoi/index',
        //     'icon' => 'fa fa-users',
        // ],
        // [
        //     'name' => 'Ổ dịch bệnh',
        //     'url' => 'quanly/odich/index',
        //     'icon' => 'fa fa-virus',
        // ],
        // [
        //     'name' => 'Cộng tác viên',
        //     'url' => 'quanly/congtacvien/index',
        //     'icon' => 'fa fa-user-tie',
        // ],
        // [
        //     'name' => 'Dẫn tinh viên',
        //     'url' => 'quanly/dantinhvien/index',
        //     'icon' => 'fa fa-user-nurse',
        // ],
    ],
//    'bsVersion' => '4.x',

];
