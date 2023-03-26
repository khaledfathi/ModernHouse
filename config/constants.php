<?php
return [    
    'transaction_type'=>[
        'payforinvoice'=>2,
        'payforproject'=>3,
    ],
    'project_status' =>[
        'open'=> 1,
        'ended_with_indebtedness'=>3,
        'ended_not_delivered'=> 4,
        'delayed'=> 5,
    ],
    'monthsNames'=>[
        'يناير',
        'فبراير',
        'مارس',
        'ابريل',
        'مايو',
        'يونيو',
        'يوليو',
        'اغسطس',
        'سبتمبر',
        'اكتوبر',
        'نوفمبر',
        'ديسمبر',
    ],
    'transaction_types_execlude'=>[2,3],
    'defaultProductImagePath'=> 'assets/images/default/default.jpg'
]; 