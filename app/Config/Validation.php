<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    public $login = [
        'username' => [
            'rules' => 'required|min_length[5]',
        ],
        'password' => [
            'rules' => 'required',
        ]
    ];
    public $login_errors = [
        'username' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimal 5 Karakter',
        ],
        'password' => [
            'required' => '{field} Harus Diisi',
        ]
    ];
    public $ganti = [
        'password' => [
            'rules' => 'required',
        ],
        'passwordbaru' => [
            'rules' => 'required',
        ],
        'passwordbaru2' => [
            'rules' => 'required',
        ]
    ];
    public $ganti_errors = [
        'password' => [
            'required' => '{field} Harus Diisi',
        ],
        'passwordbaru' => [
            'required' => '{field} Harus Diisi',
        ],
        'passwordbaru2' => [
            'required' => '{field} Harus Diisi',
        ]
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
}
