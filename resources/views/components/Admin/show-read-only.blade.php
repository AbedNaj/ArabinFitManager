@props(['icon' => '', 'label' => ''])
<div class="group">
    <div class="flex items-center space-x-3 rtl:space-x-reverse mb-3">
        <div
            class="w-10 h-10 bg-gradient-to-br from-primary to-indigo-600 dark:from-primary dark:to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
            {!! $icon !!}
        </div>
        <div>
            <h3 class="text-xs sm:text-sm font-medium text-secondary dark:text-secondary uppercase tracking-wider">
                {{ $label }}
            </h3>
        </div>
    </div>
    <div
        class="bg-surface dark:bg-surface rounded-xl p-4 group-hover:bg-gray-100 dark:group-hover:bg-slate-600 transition-colors duration-200 border border-border/50">
        <p class="text-lg font-semibold text-text dark:text-text break-words">
            {{ $slot }}
        </p>
    </div>
</div>
