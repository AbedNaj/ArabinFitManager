@extends('admin.layout.default')
@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6" :class="{ 'flex-row-reverse': isRTL }">
            <h1 class="text-2xl font-bold" x-text="isRTL ? 'نظرة عامة على لوحة التحكم' : 'Dashboard Overview'">
            </h1>
            <button class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" :class="{ 'mr-0 ml-1': isRTL }"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                <span x-text="isRTL ? 'تقرير جديد' : 'New Report'"></span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-bg p-5 rounded-xl border border-border">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-secondary mb-1" x-text="isRTL ? 'إجمالي الإيرادات' : 'Total Revenue'"></p>
                        <p class="text-2xl font-bold">$24,780</p>
                    </div>
                    <div class="p-2 rounded-lg bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-green-500 mt-2">
                    <span>↑ 12.5%</span> <span x-text="isRTL ? 'من الشهر الماضي' : 'from last month'"></span>
                </p>
            </div>

            <div class="bg-bg p-5 rounded-xl border border-border">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-secondary mb-1" x-text="isRTL ? 'المستخدمون النشطون' : 'Active Users'"></p>
                        <p class="text-2xl font-bold">12,489</p>
                    </div>
                    <div class="p-2 rounded-lg bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-green-500 mt-2">
                    <span>↑ 5.2%</span> <span x-text="isRTL ? 'من الشهر الماضي' : 'from last month'"></span>
                </p>
            </div>

            <div class="bg-bg p-5 rounded-xl border border-border">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-secondary mb-1" x-text="isRTL ? 'طلبات جديدة' : 'New Orders'">
                        </p>
                        <p class="text-2xl font-bold">1,248</p>
                    </div>
                    <div class="p-2 rounded-lg bg-orange-100 text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-green-500 mt-2">
                    <span>↑ 8.7%</span> <span x-text="isRTL ? 'من الشهر الماضي' : 'from last month'"></span>
                </p>
            </div>

            <div class="bg-bg p-5 rounded-xl border border-border">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-secondary mb-1" x-text="isRTL ? 'معدل التحويل' : 'Conversion Rate'"></p>
                        <p class="text-2xl font-bold">28.6%</p>
                    </div>
                    <div class="p-2 rounded-lg bg-purple-100 text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-red-500 mt-2">
                    <span>↓ 1.2%</span> <span x-text="isRTL ? 'من الشهر الماضي' : 'from last month'"></span>
                </p>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            <div class="lg:col-span-2 bg-bg p-5 rounded-xl border border-border">
                <div class="flex justify-between items-center mb-4" :class="{ 'flex-row-reverse': isRTL }">
                    <h3 class="font-bold" x-text="isRTL ? 'نظرة عامة على الإيرادات' : 'Revenue Overview'">
                    </h3>
                    <div class="flex space-x-2" :class="{ 'space-x-reverse': isRTL }">
                        <button class="text-xs px-3 py-1 rounded-lg bg-primary/10 text-primary"
                            x-text="isRTL ? 'شهرياً' : 'Month'"></button>
                        <button class="text-xs px-3 py-1 rounded-lg bg-surface hover:bg-border"
                            x-text="isRTL ? 'أسبوعياً' : 'Week'"></button>
                        <button class="text-xs px-3 py-1 rounded-lg bg-surface hover:bg-border"
                            x-text="isRTL ? 'يومياً' : 'Day'"></button>
                    </div>
                </div>

                <div class="h-64">

                    <div class="w-full h-full flex items-end space-x-2 pt-4">
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-3/4 bg-primary/20 rounded-t h-3/5"></div>
                            <span class="text-xs text-secondary mt-2" x-text="isRTL ? 'الإثنين' : 'Mon'"></span>
                        </div>
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-3/4 bg-primary rounded-t h-4/5"></div>
                            <span class="text-xs text-secondary mt-2" x-text="isRTL ? 'الثلاثاء' : 'Tue'"></span>
                        </div>
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-3/4 bg-primary/20 rounded-t h-2/5"></div>
                            <span class="text-xs text-secondary mt-2" x-text="isRTL ? 'الأربعاء' : 'Wed'"></span>
                        </div>
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-3/4 bg-primary/20 rounded-t h-3/5"></div>
                            <span class="text-xs text-secondary mt-2" x-text="isRTL ? 'الخميس' : 'Thu'"></span>
                        </div>
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-3/4 bg-primary rounded-t h-4/5"></div>
                            <span class="text-xs text-secondary mt-2" x-text="isRTL ? 'الجمعة' : 'Fri'"></span>
                        </div>
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-3/4 bg-primary/20 rounded-t h-1/3"></div>
                            <span class="text-xs text-secondary mt-2" x-text="isRTL ? 'السبت' : 'Sat'"></span>
                        </div>
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-3/4 bg-primary/20 rounded-t h-1/2"></div>
                            <span class="text-xs text-secondary mt-2" x-text="isRTL ? 'الأحد' : 'Sun'"></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="bg-bg p-5 rounded-xl border border-border">
                <h3 class="font-bold mb-4" x-text="isRTL ? 'النشاطات الحديثة' : 'Recent Activity'"></h3>

                <div class="space-y-4">
                    <div class="flex" :class="{ 'flex-row-reverse': isRTL }">
                        <div class="mr-3" :class="{ 'ml-3 mr-0': isRTL }">
                            <div
                                class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium" x-text="isRTL ? 'تم استلام الدفع' : 'Payment received'">
                            </p>
                            <p class="text-sm text-secondary"
                                x-text="isRTL ? 'محمد أحمد دفع $250.00' : 'John Doe paid $250.00'"></p>
                            <p class="text-xs text-secondary mt-1" x-text="isRTL ? 'قبل ساعتين' : '2 hours ago'"></p>
                        </div>
                    </div>

                    <div class="flex" :class="{ 'flex-row-reverse': isRTL }">
                        <div class="mr-3" :class="{ 'ml-3 mr-0': isRTL }">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium" x-text="isRTL ? 'رسالة جديدة' : 'New message'"></p>
                            <p class="text-sm text-secondary"
                                x-text="isRTL ? 'لديك رسالة جديدة من سارة' : 'You have a new message from Sarah'">
                            </p>
                            <p class="text-xs text-secondary mt-1" x-text="isRTL ? 'قبل 5 ساعات' : '5 hours ago'"></p>
                        </div>
                    </div>

                    <div class="flex" :class="{ 'flex-row-reverse': isRTL }">
                        <div class="mr-3" :class="{ 'ml-3 mr-0': isRTL }">
                            <div
                                class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium" x-text="isRTL ? 'مستخدم جديد' : 'New user'"></p>
                            <p class="text-sm text-secondary"
                                x-text="isRTL ? 'تم تسجيل مستخدم جديد' : 'New user registered'"></p>
                            <p class="text-xs text-secondary mt-1" x-text="isRTL ? 'قبل يوم واحد' : '1 day ago'"></p>
                        </div>
                    </div>

                    <div class="flex" :class="{ 'flex-row-reverse': isRTL }">
                        <div class="mr-3" :class="{ 'ml-3 mr-0': isRTL }">
                            <div
                                class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium" x-text="isRTL ? 'تحديث المشروع' : 'Project updated'"></p>
                            <p class="text-sm text-secondary"
                                x-text="isRTL ? 'تم تحديث تصميم لوحة التحكم' : 'Dashboard design updated'"></p>
                            <p class="text-xs text-secondary mt-1" x-text="isRTL ? 'قبل يومين' : '2 days ago'"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
