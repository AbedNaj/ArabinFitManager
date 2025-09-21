@extends('superAdmin.layout.default')

@section('content')
    <section class="max-w-6xl mx-auto p-4 md:p-6">

        <!-- العنوان + أزرار سريعة -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">{{ __('super_admin.gym_overview') ?? 'نظرة عامة على النادي' }}
                </h1>
                <p class="text-sm text-[--color-accent]">إدارة بيانات النادي، النطاقات، خطة الاشتراك، والصلاحيات.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <button class="px-3 py-2 rounded-md border border-border bg-surface hover:bg-[--color-surface] text-sm">تحديث
                    البيانات</button>
                <button class="px-3 py-2 rounded-md bg-secondary text-white hover:opacity-90 text-sm">إرسال رسالة
                    للمالك</button>
                <button class="px-3 py-2 rounded-md bg-primary text-white hover:opacity-90 text-sm">إنشاء فاتورة
                    يدوية</button>
            </div>
        </div>

        <!-- بطاقة معلومات النادي -->
        <div class="bg-bg rounded-md border border-border p-4 md:p-6 mb-6">
            <div class="flex items-start gap-4">
                <div
                    class="h-16 w-16 rounded-lg bg-surface border border-border flex items-center justify-center overflow-hidden">
                    <!-- شعار النادي (صورة ثابتة كمثال) -->
                    <img src="https://placehold.co/64x64" alt="Logo" class="h-16 w-16 object-cover">
                </div>

                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                        <div>
                            <h2 class="text-xl font-semibold">ArabianFit Gym</h2>
                            <p class="text-sm text-[--color-accent]">رقم النادي (Tenant): <span
                                    class="font-mono">TEN-000123</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs px-2 py-1 rounded-md border border-border">الخطة:
                                <strong>Pro</strong></span>
                            <span class="text-xs px-2 py-1 rounded-md bg-[--color-surface] border border-border">الحالة:
                                <strong class="text-green-600">نشط</strong></span>
                            <span class="text-xs px-2 py-1 rounded-md border border-border">المنطقة الزمنية:
                                Asia/Hebron</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div class="rounded-md border border-border p-3">
                            <div class="text-xs text-[--color-accent]">النطاق الأساسي</div>
                            <div class="mt-1 font-medium">gym.arabianfit.com</div>
                        </div>
                        <div class="rounded-md border border-border p-3">
                            <div class="text-xs text-[--color-accent]">تاريخ الإنشاء</div>
                            <div class="mt-1 font-medium">2025-08-10</div>
                        </div>
                        <div class="rounded-md border border-border p-3">
                            <div class="text-xs text-[--color-accent]">تجديد الاشتراك</div>
                            <div class="mt-1 font-medium">2025-10-10</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- المالك + الاتصال -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="rounded-md border border-border p-4">
                    <div class="text-xs text-[--color-accent] mb-1">مالك النادي</div>
                    <div class="font-medium">أحمد علي</div>
                    <div class="text-sm text-[--color-accent]">admin@gym.com</div>
                    <div class="text-sm text-[--color-accent]">+970 59 000 0000</div>
                </div>

                <div class="rounded-md border border-border p-4">
                    <div class="text-xs text-[--color-accent] mb-1">الفوترة</div>
                    <div class="flex items-center justify-between text-sm">
                        <span>طريقة الدفع</span><span class="font-medium">بطاقة ائتمانية</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span>الرصيد الحالي</span><span class="font-medium">0.00$</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span>آخر دفعة</span><span class="font-medium">2025-09-01 — 19.00$</span>
                    </div>
                    <div class="mt-3 flex gap-2">
                        <button class="px-3 py-2 rounded-md border border-border text-sm">عرض الفواتير</button>
                        <button class="px-3 py-2 rounded-md bg-secondary text-white hover:opacity-90 text-sm">تعديل
                            الخطة</button>
                    </div>
                </div>

                <div class="rounded-md border border-border p-4">
                    <div class="text-xs text-[--color-accent] mb-1">استخدام الموارد</div>
                    <div class="space-y-2">
                        <div>
                            <div class="flex items-center justify-between text-sm"><span>المستخدمون</span><span>18/50</span>
                            </div>
                            <div class="h-2 bg-surface rounded-full overflow-hidden">
                                <div class="h-full w-[36%] bg-primary"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-sm">
                                <span>المشتركين</span><span>430/2000</span></div>
                            <div class="h-2 bg-surface rounded-full overflow-hidden">
                                <div class="h-full w-[21.5%] bg-primary"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-sm"><span>السعة
                                    التخزينية</span><span>3.2GB/20GB</span></div>
                            <div class="h-2 bg-surface rounded-full overflow-hidden">
                                <div class="h-full w-[16%] bg-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- النطاقات الإضافية / البديلة -->
        <div class="bg-bg rounded-md border border-border p-4 md:p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">النطاقات المرتبطة</h3>
                <button class="px-3 py-2 rounded-md border border-border text-sm">إضافة نطاق</button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-[--color-accent]">
                        <tr class="border-b border-border">
                            <th class="py-2 text-start">النطاق</th>
                            <th class="py-2 text-start">النوع</th>
                            <th class="py-2 text-start">SSL</th>
                            <th class="py-2 text-start">الحالة</th>
                            <th class="py-2 text-start">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-border">
                            <td class="py-3 font-medium">gym.arabianfit.com</td>
                            <td>أساسي</td>
                            <td>مفعّل</td>
                            <td><span class="text-green-600">نشط</span></td>
                            <td class="flex gap-2 py-2">
                                <button class="px-2 py-1 rounded-md border border-border">تعيين كافتراضي</button>
                                <button class="px-2 py-1 rounded-md border border-border">إزالة</button>
                            </td>
                        </tr>
                        <tr class="border-b border-border">
                            <td class="py-3 font-medium">arabianfit-gym.com</td>
                            <td>مخصص</td>
                            <td>بانتظار</td>
                            <td><span class="text-yellow-600">قيد الإعداد</span></td>
                            <td class="flex gap-2 py-2">
                                <button class="px-2 py-1 rounded-md border border-border">تفعيل SSL</button>
                                <button class="px-2 py-1 rounded-md border border-border">إزالة</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- التحكم بالأدوار والصلاحيات -->
        <div class="bg-bg rounded-md border border-border p-4 md:p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                <h3 class="text-lg font-semibold">الأدوار والصلاحيات</h3>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-2 rounded-md border border-border text-sm">إضافة دور</button>
                    <button class="px-3 py-2 rounded-md border border-border text-sm">إدارة الصلاحيات</button>
                </div>
            </div>

            <!-- أدوار جاهزة -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- بطاقة دور: مدير عام -->
                <div class="rounded-md border border-border p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium">Admin</h4>
                        <span class="text-xs px-2 py-1 rounded-md bg-surface border border-border">13 مستخدم</span>
                    </div>
                    <p class="text-sm text-[--color-accent] mb-3">صلاحيات كاملة على مستوى النادي.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs px-2 py-1 rounded-md border border-border">view dashboard</span>
                        <span class="text-xs px-2 py-1 rounded-md border border-border">manage users</span>
                        <span class="text-xs px-2 py-1 rounded-md border border-border">manage billing</span>
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <button class="px-3 py-2 rounded-md border border-border text-sm">تعديل</button>
                        <button class="px-3 py-2 rounded-md border border-border text-sm">تعيين لمستخدمين</button>
                    </div>
                </div>

                <!-- بطاقة دور: موظف -->
                <div class="rounded-md border border-border p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium">Employee</h4>
                        <span class="text-xs px-2 py-1 rounded-md bg-surface border border-border">5 مستخدمين</span>
                    </div>
                    <p class="text-sm text-[--color-accent] mb-3">صلاحيات تشغيلية (الاشتراكات، الفواتير، الحضور).</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs px-2 py-1 rounded-md border border-border">view customers</span>
                        <span class="text-xs px-2 py-1 rounded-md border border-border">create invoices</span>
                        <span class="text-xs px-2 py-1 rounded-md border border-border">mark attendance</span>
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <button class="px-3 py-2 rounded-md border border-border text-sm">تعديل</button>
                        <button class="px-3 py-2 rounded-md border border-border text-sm">تعيين لمستخدمين</button>
                    </div>
                </div>

                <!-- بطاقة دور: قارئ -->
                <div class="rounded-md border border-border p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium">Viewer</h4>
                        <span class="text-xs px-2 py-1 rounded-md bg-surface border border-border">2 مستخدمين</span>
                    </div>
                    <p class="text-sm text-[--color-accent] mb-3">صلاحيات عرض فقط.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs px-2 py-1 rounded-md border border-border">view dashboard</span>
                        <span class="text-xs px-2 py-1 rounded-md border border-border">view reports</span>
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <button class="px-3 py-2 rounded-md border border-border text-sm">تعديل</button>
                        <button class="px-3 py-2 rounded-md border border-border text-sm">تعيين لمستخدمين</button>
                    </div>
                </div>
            </div>

            <!-- مصفوفة صلاحيات (عرض فقط) -->
            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-[--color-accent]">
                        <tr class="border-b border-border">
                            <th class="py-2 text-start">الصلاحية</th>
                            <th class="py-2 text-center">Admin</th>
                            <th class="py-2 text-center">Employee</th>
                            <th class="py-2 text-center">Viewer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-border">
                            <td class="py-3">manage users</td>
                            <td class="text-center">✔</td>
                            <td class="text-center">—</td>
                            <td class="text-center">—</td>
                        </tr>
                        <tr class="border-b border-border">
                            <td class="py-3">view customers</td>
                            <td class="text-center">✔</td>
                            <td class="text-center">✔</td>
                            <td class="text-center">✔</td>
                        </tr>
                        <tr class="border-b border-border">
                            <td class="py-3">create invoices</td>
                            <td class="text-center">✔</td>
                            <td class="text-center">✔</td>
                            <td class="text-center">—</td>
                        </tr>
                        <tr class="border-b border-border">
                            <td class="py-3">manage billing</td>
                            <td class="text-center">✔</td>
                            <td class="text-center">—</td>
                            <td class="text-center">—</td>
                        </tr>
                        <tr class="border-b border-border">
                            <td class="py-3">view reports</td>
                            <td class="text-center">✔</td>
                            <td class="text-center">✔</td>
                            <td class="text-center">✔</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- سجّل النشاط -->
        <div class="bg-bg rounded-md border border-border p-4 md:p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">سجل النشاط</h3>
                <button class="px-3 py-2 rounded-md border border-border text-sm">تصدير CSV</button>
            </div>
            <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <div class="h-2 w-2 rounded-full bg-primary mt-2"></div>
                    <div>
                        <div class="font-medium">تمت ترقية الخطة إلى Pro</div>
                        <div class="text-xs text-[--color-accent]">2025-09-09 13:21</div>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="h-2 w-2 rounded-full bg-primary mt-2"></div>
                    <div>
                        <div class="font-medium">إضافة نطاق مخصص arabianfit-gym.com</div>
                        <div class="text-xs text-[--color-accent]">2025-09-08 18:02</div>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="h-2 w-2 rounded-full bg-primary mt-2"></div>
                    <div>
                        <div class="font-medium">إضافة مستخدم جديد (employee@arabianfit.com)</div>
                        <div class="text-xs text-[--color-accent]">2025-09-07 09:47</div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- منطقة خطرة -->
        <div class="bg-bg rounded-md border border-border p-4 md:p-6">
            <h3 class="text-lg font-semibold mb-3">المنطقة الخَطِرة</h3>
            <p class="text-sm text-[--color-accent] mb-4">هذه الإجراءات لا يمكن التراجع عنها. يرجى الحذر.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="rounded-md border border-border p-4">
                    <div class="font-medium mb-1">إيقاف النادي مؤقتًا</div>
                    <p class="text-sm text-[--color-accent] mb-3">لن يتمكن المستخدمون من تسجيل الدخول خلال فترة الإيقاف.
                    </p>
                    <button class="px-3 py-2 rounded-md bg-[crimson] text-white hover:opacity-90 text-sm">إيقاف
                        مؤقت</button>
                </div>
                <div class="rounded-md border border-border p-4">
                    <div class="font-medium mb-1">حذف النادي نهائيًا</div>
                    <p class="text-sm text-[--color-accent] mb-3">سيتم حذف جميع البيانات المتعلقة بهذا النادي نهائيًا.</p>
                    <button class="px-3 py-2 rounded-md bg-[crimson] text-white hover:opacity-90 text-sm">حذف
                        نهائي</button>
                </div>
            </div>
        </div>

    </section>
@endsection
