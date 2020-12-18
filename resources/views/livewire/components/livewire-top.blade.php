<div x-cloak x-data="TOP_DATA()" class="border-b py-2 px-4 select-none flex justify-between items-center">
    <x-heroicon-s-light-bulb x-on:click="setTheme('light')" x-show="currentTheme == 'dark' || !localStorage.theme" class="w-6 h-6 text-gray-400"/>
    <x-heroicon-s-moon x-on:click="setTheme('dark')" x-show="currentTheme == 'light'" class="w-6 h-6 text-gray-400"/>
    <span class="font-light">{{ $user->name }}</span>
</div>


<script>
    function TOP_DATA() {
        return {
            currentTheme: localStorage.theme,
            setTheme(theme = "light") {
                console.warn('clicked');
                if(theme == "light") {
                    document.querySelector('html').classList.remove('dark')
                } else {
                    document.querySelector('html').classList.add('dark')
                }
                this.currentTheme = theme;
                localStorage.theme = theme;
            },
        }
    }
</script>

