<?php

// Rules copied from route4me/r4m-shared-modules, so the SDK follows the same style.

$rules = [
    // Array Notation
    'array_syntax' => [
        'syntax' => 'short'
    ],
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_whitespace_before_comma_in_array' => true,
    'normalize_index_brace' => true,
    'trim_array_spaces' => true,
    'whitespace_after_comma_in_array' => true,

    // Namespace notation
    'blank_line_after_namespace' => true,
    'no_leading_namespace_whitespace' => true,
    'clean_namespace' => true,

    // Function Notation
    'function_declaration' => [
        'closure_function_spacing' => 'one',
        'closure_fn_spacing' => 'one',
        'trailing_comma_single_line' => true,
    ],
    'method_argument_space' => [
        'keep_multiple_spaces_after_comma' => false,
        'on_multiline' => 'ensure_fully_multiline',
        'after_heredoc' => true,
    ],
    'no_spaces_after_function_name' => true,
    'no_unreachable_default_argument_value' => true,
    'single_line_throw' => false,

    // PHP Tag
    'blank_line_after_opening_tag' => true,
    'full_opening_tag' => true,
    'linebreak_after_opening_tag' => true,
    'no_closing_tag' => true,

    // Basic
    'braces_position' => true, // Use default configuration
    'encoding' => true,
    'no_trailing_comma_in_singleline' => true,
    'psr_autoloading' => true,

    // Cast Notation
    'cast_spaces' => [
        'space' => 'none'
    ],
    'lowercase_cast' => true,
    'no_short_bool_cast' => true,
    'short_scalar_cast' => true,

    // Operator
    'concat_space' => [
        'spacing' => 'one',
    ],
    'unary_operator_spaces' => true,
    'ternary_to_null_coalescing' => true,
    'ternary_operator_spaces' => true,
    'object_operator_without_whitespace' => true,
    'not_operator_with_successor_space' => false,
    'binary_operator_spaces' => [
        'default' => 'single_space',
        'operators' => [
            '=>' => 'single_space',
            '=' => 'single_space',
        ],
    ],
    'standardize_not_equals' => true,

    // Language Construct
    'declare_equal_normalize' => [
        'space' => 'single'
    ],

    // Control Structure
    'elseif' => false,
    'include' => true,
    'switch_case_space' => true,
    'switch_case_semicolon_to_colon' => true,
    'yoda_style' => [
        'equal' => false,
        'identical' => false,
        'less_and_greater' => false
    ],
    'trailing_comma_in_multiline' => [
        'elements' => ['arrays']
    ],
    'no_unneeded_control_parentheses' => [
        'statements' => ['break', 'clone', 'continue', 'echo_print', 'return', 'switch_case', 'yield'],
    ],

    // Import
    'fully_qualified_strict_types' => true,
    'no_leading_import_slash' => true,
    'no_unused_imports' => true,
    'single_import_per_statement' => true,
    'single_line_after_imports' => true,
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
    ],

    // Whitespace
    'indentation_type' => true,
    'line_ending' => true,
    'no_whitespace_in_blank_line' => true,
    'method_chaining_indentation' => true,
    'single_blank_line_at_eof' => true,
    'type_declaration_spaces' => [
        "elements" => ['function', 'property']
    ],
    'no_extra_blank_lines' => [
        'tokens' => [
            'extra',
            'throw',
            'use',
            'use_trait',
        ],
    ],
    'spaces_inside_parentheses' => [
        'space' => 'none',
    ],
    'blank_line_before_statement' => [
        'statements' => ['return', 'try'],
    ],
    'no_spaces_around_offset' => [
        'positions' => ['inside', 'outside'],
    ],

    // String Notation
    'heredoc_to_nowdoc' => true,
    'single_quote' => true,

    // Casing
    'lowercase_keywords' => true,
    'lowercase_static_reference' => true, // added from Symfony
    'magic_method_casing' => true, // added from Symfony
    'magic_constant_casing' => true,
    'native_function_casing' => true,
    'integer_literal_case' => true,
    'constant_case' => [
        'case' => 'lower'
    ],

    // Alias
    'no_alias_functions' => ["sets" => ['@all']],
    'no_mixed_echo_print' => [
        'use' => 'echo',
    ],

    // Class Notation
    'self_accessor' => true,
    'no_blank_lines_after_class_opening' => true,
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'one',
            'method' => 'one',
        ],
    ],
    'class_definition' => [
        'multi_line_extends_each_single_line' => true,
        'single_item_single_line' => true,
        'single_line' => true,
    ],
    'visibility_required' => [
        'elements' => ['property', 'method'],
    ],

    // Semicolon
    'no_empty_statement' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line'
    ],
    'space_after_semicolon' => true,

    // Return Notation
    'no_useless_return' => false,
    'simplified_null_return' => false,

    // Comment
    'no_trailing_whitespace' => true,
    'no_trailing_whitespace_in_comment' => true,
    'single_line_comment_style' => [
        'comment_types' => ['hash'],
    ],

    // PHPDoc
    'no_blank_lines_after_phpdoc' => true,
    'no_empty_phpdoc' => true,
    'phpdoc_line_span' => [
        'property' => 'multi'
    ],
    'general_phpdoc_tag_rename' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_tag_type' => true,
    'phpdoc_indent' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_scalar' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
];

// The shared list turns on 4 risky rules without allowing risky fixers, which
// php-cs-fixer 3.95 rejects. Keep them off: risky rules can change behavior.
foreach (['no_alias_functions', 'no_unreachable_default_argument_value', 'psr_autoloading', 'self_accessor'] as $rule) {
    $rules[$rule] = false;
}

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['vendor', 'node_modules']);

return (new PhpCsFixer\Config())->setRules($rules)->setFinder($finder);
