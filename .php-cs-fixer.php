<?php

declare(strict_types=1);

return
    (new PhpCsFixer\Config())
        ->setCacheFile(__DIR__ . '/var/php-cs.cache')
        ->setFinder(
            PhpCsFixer\Finder::create()
                ->in([
                    __DIR__ . '/src',
                    __DIR__ . '/Tests'
                ])
        )
        ->setRules([
        // ==================== НАБОРЫ ПРАВИЛ (PRESETS) ====================

            // Базовый стандарт PSR-12 для оформления PHP кода
            '@PSR12' => true,

            // Рискованные правила PSR-12 (могут изменить поведение программы)
            '@PSR12:risky' => true,

            // Автоматическое обновление синтаксиса для PHP 8.1
            '@PHP8x1Migration' => true,

            // Рискованные правила миграции на PHP 8.1
            '@PHP8x1Migration:risky' => true,

            // Правила миграции для PHPUnit 8.4 (для тестов)
            '@PHPUnit8x4Migration:risky' => true,

            // ==================== ОПТИМИЗАЦИЯ ИМПОРТОВ ====================

            // Удаляет неиспользуемые импорты (use statements)
            'no_unused_imports' => true,

            // Сортирует импорты в заданном порядке
            'ordered_imports' => [
                'imports_order' => ['class', 'function', 'const'], // Сначала классы, потом функции, потом константы
            ],

            // ==================== ОЧИСТКА PHPDOC ====================

            // Удаляет избыточные аннотации @param, @return, @var, которые можно вывести из типа
            'no_superfluous_phpdoc_tags' => [
                'remove_inheritdoc' => true, // Также удаляет @inheritDoc там, где он не нужен
            ],

            // ==================== ФОРМАТИРОВАНИЕ PHPDOC ====================

            // Всегда ставит null в конец списка типов в аннотациях
            // Было: @param string|null $name → Станет: @param string|null $name
            // Было: @param null|string $name → Станет: @param string|null $name
            'phpdoc_types_order' => [
                'null_adjustment' => 'always_last', // null всегда в конце
            ],

            // ==================== СТРОГАЯ ТИПИЗАЦИЯ ====================

            // Заменяет нестрогие сравнения (==, !=) на строгие (===, !==)
            'strict_comparison' => true,

            // Включает strict_types=1 в файлах, где есть объявления типов
            'strict_param' => true,

            // ==================== ФОРМАТИРОВАНИЕ КОДА ====================

            // Убирает лишние пробелы перед точкой с запятой в многострочных выражениях
            'multiline_whitespace_before_semicolons' => [
                'strategy' => 'no_multi_line', // Не допускает переносов строк перед ;
            ],

            // ==================== УПРОЩЕНИЕ УСЛОВИЙ ====================

            // Убирает избыточные elseif, когда можно использовать if
            'no_superfluous_elseif' => true,

            // Убирает else, если в if есть гарантированный return/throw/continue/break
            'no_useless_else' => true,

            // Убирает return в конце функции, если он ничего не возвращает
            'no_useless_return' => true,

            // ==================== PHPUNIT ПРАВИЛА ====================

            // Добавляет @internal аннотацию для внутренних тестовых классов
            'php_unit_internal_class' => true,

            // Заменяет обычные конструкторы на статические методы PHPUnit (например, createMock())
            'php_unit_construct' => true,

            // Требует полных квалифицированных имен классов в аннотациях PHPUnit
            'php_unit_fqcn_annotation' => true,

            // Устанавливает правильную видимость (protected) для методов setUp() и tearDown()
            'php_unit_set_up_tear_down_visibility' => true,

            // Заменяет $this->method() на self::method() для статических вызовов в тестах
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'self', // Использует self:: вместо static::
            ],

            // ==================== ООП И КЛАССЫ ====================

            // Делает все классы final, если они не наследуются и не помечены как abstract
            // 'final_class' => true,

            // Делает public методы в абстрактных классах final, чтобы их нельзя было переопределить
            // 'final_public_method_for_abstract_class' => true,

            // Заменяет static:: на self:: там, где это безопасно (не ломает late static binding)
            'self_static_accessor' => true,

            // ==================== ЗАМЫКАНИЯ ====================

            // Делает замыкания статическими там, где они не используют $this
            'static_lambda' => true,

            // ==================== ПРОСТРАНСТВА ИМЕН ====================

            // Использует импорты из глобального пространства имен вместо полных путей
            'global_namespace_import' => true,
        ]);