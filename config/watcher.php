<?php

return [

    'position' => env('CAMPAIGN_POSITION', 'Mayor of Quezon City'),

    'tasks' => [
        'preparation' => [
            'display' => 'preparation',
            'description' => 'Ea quo sonet persius mediocrem, mel cu agam mazim intellegebat. Libris consequat no cum, dicant intellegam vis id. Dolorem mandamus vis no, an quas blandit nec, an tibique deseruisse contentiones vim. Suscipit euripidis ne sea, mea habeo inciderint te. Ne eos sale essent.',
            'checklist' => [
                'credentials' => 'ID, authorization, etc.',
                'materials'   => 'pen, paper, cellphone with load, whistle',
                'meal'        => 'eat a hearty meal and bring baon',
            ],
            'alarms' => [
                'sick' => 'Not feeling well? /task_preparation_alarm_sick',
            ],
        ],
        'precinct' => [
            'display' => 'precinct operations',
            'description' => 'At modo audire expetendis pri, nisl mundi appellantur id vix. Fugit concludaturque vituperatoribus vim te, elit liber discere eos no. Consul referrentur id sed, justo albucius te usu. Alia appetere mea at. Possit molestiae torquatos mel no.',
            'checklist' => [
                'bei' => 'Verify composition of the board of election inspectors. If done please click /task_precinct_checklist_bei.',
                'seal' => 'Inspect the seal if intact? If done please click /task_precinct_checklist_seal.',
                'zero' => 'Witness the printing of zero votes from start to finish? If done please click /task_precinct_checklist_zero.',
            ],
            'alarms' => [
                'nostart' => 'Voting has not started! /task_precinct_alarm_nostart',
                'noseal' => 'There is no seal! /task_precinct_alarm_noseal',
                'nozero' => 'There is no zero report! /task_precinct_alarm_nozero',
            ],
        ],
        'pcos' => [
            'display' => 'PCOS operations',
            'description' => 'At vis porro senserit percipitur, debitis iracundia eam et. Et sale ipsum everti nec. Vim ea tempor aliquam splendide, saepe sapientem id sea. Ne hinc nostrum omittam eam. Pri accusata efficiendi an. Qui eirmod minimum ea, sit ea dicit aliquip.',
            'checklist' => [
            ],
            'alarms' => [
                'jam' => '. If done please click /task_pcos_alarm_jam.',
                'scan' => 'Inspect the seal if intact? If done please click /task_pcos_alarm_scan.',
                'print' => 'Witness the printing of zero votes from start to finish? If done please click /task_pcos_alarm_print.',
            ],
        ],
    ],

];
