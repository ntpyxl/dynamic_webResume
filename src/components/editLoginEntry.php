<div class="flex fixed inset-0 z-20 bg-black/50 backdrop-blur-sm justify-center items-center">
    <div class="max-w-[600px] bg-gray-800 px-6 py-4 rounded-xl shadow-xl relative">
        <div class="flex w-full justify-between">
            <p class="mr-3 mt-2 mb-1 font-light">
                Do you want to make changes? Log in below.
            </p>

            <div
                @click="modalOpen = !modalOpen"
                class="flex w-10 h-10 p-2 text-2xl rounded-2xl justify-center hover:bg-gray-700 cursor-pointer select-none">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <form class="flex flex-col py-3 gap-5">
            <div class="flex flex-col gap-3">
                <div class="flex flex-col">
                    <p class="w-full text-xl select-none cursor-default">Username</p>
                    <input
                        type="text"
                        class="border px-3 py-1 border-white rounded-2xl">
                    </input>
                </div>

                <div class="flex flex-col">
                    <p class="w-full text-xl select-none cursor-default">Password</p>
                    <input
                        type="password"
                        class="border px-3 py-1 border-white rounded-2xl">
                    </input>
                </div>
            </div>

            <div class="flex w-full justify-end">
                <button
                    class="px-5 py-1 border-2 border-white rounded-4xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>