<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="tailwindStyles.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="scripts/navbarComponent.js"></script>
    <script src="scripts/aboutComponent.js"></script>
    <script src="scripts/techSkillComponent.js"></script>
    <script src="scripts/projectComponent.js"></script>
    <script src="scripts/educationComponent.js"></script>
    <script src="scripts/contactComponent.js"></script>
    <script src="scripts/userComponent.js"></script>

    <title>Francis Abaya Resume</title>
</head>

<body class="flex bg-gray-900 text-white">
    <aside class="sticky top-0 h-screen px-3 py-1 bg-gray-800 drop-shadow-xl">
        <nav class="flex flex-col h-full justify-between">
            <div x-data="navbarSectionComponent()" x-cloak class="flex flex-col mt-3 gap-5">
                <template x-for="(section, name) in sections" :key="name">
                    <div class="relative group">
                        <a
                            :href="section.Link"
                            class="flex w-10 p-2 text-2xl rounded-2xl justify-center hover:bg-gray-700 cursor-pointer select-none">
                            <i :class="section.Icon"></i>
                        </a>

                        <div class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-3 py-2 rounded-lg bg-gray-800 text-white opacity-0 whitespace-nowrap text-sm pointer-events-none
                                    group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-200 shadow-lg">
                            <span x-text="name"></span>
                        </div>
                    </div>
                </template>
            </div>

            <div x-data="{ modalOpen: false }">
                <div class="relative group mb-3">
                    <div
                        @click="modalOpen = !modalOpen"
                        class="flex w-10 p-2 text-2xl rounded-2xl justify-center hover:bg-gray-700 cursor-pointer select-none">
                        <i class="fa-solid fa-gears"></i>
                    </div>

                    <div class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-3 py-2 rounded-lg bg-gray-800 text-white opacity-0 whitespace-nowrap text-sm group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-200 shadow-lg">
                        Settings
                    </div>
                </div>

                <template x-teleport="body">
                    <div x-show="modalOpen" x-cloak x-transition>
                        <?php include 'components/editLoginEntry.php' ?>
                    </div>
                </template>
            </div>

        </nav>
    </aside>

    <main id="mainSection" class="flex-1 p-3">
        <div class="flex w-fit mx-auto mt-10 mb-64 px-36 bg-gray-800 space-x-24">
            <img
                src="images/francis_heroImage.png"
                class="h-[700px]">

            <div class="flex flex-col my-auto">
                <p class="text-6xl">Hello, I'm <span class="text-amber-100 font-bold">Francis Abaya</span>.</p>
                <p class="text-5xl">I am a <span class="text-amber-100 font-bold">software engineer</span>.</p>
                <a
                    href="#aboutMeSection"
                    class="mx-auto mt-8 px-4 py-3 border-2 border-amber-100 rounded-4xl text-2xl text-amber-100 hover:bg-amber-100 hover:text-gray-900 transform transition-transform duration-150 hover:translate-y-1 cursor-pointer select-none">
                    <i class="fa-solid fa-chevron-down"></i>
                </a>
            </div>
        </div>

        <div
            id="aboutMeSection"
            x-data="{ ...aboutMeComponent(),  modalOpen: false }"
            x-init="getData().then(data => loadParseData(data))"
            class="flex flex-col mx-16 mt-64 mb-12">
            <h3 class="flex flex-row font-bold text-6xl items-center">
                About Me
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div
                        @click="
                            openModal();
                            modalOpen = !modalOpen;
                            document.body.classList.toggle('modal-open', modalOpen);
                        "
                        class="text-2xl mx-3 px-3 py-2 rounded-4xl hover:bg-gray-700 cursor-pointer select-none">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                <?php } ?>
            </h3>
            <!-- Intro: Can be edited in dynamic webpage -->
            <p class="text-2xl font-light wrap-break-word">
                <span x-text="intro"></span>
            </p>

            <div class="mx-10 my-7 space-y-3">
                <!-- Life Motto: Can be edited in dynamic webpage -->
                <div>
                    <h4 class="font-bold text-4xl">Life Motto</h4>
                    <p class="font-light text-xl">
                        <span x-text="motto"></span>
                    </p>
                </div>

                <div class="flex flex-wrap p-3 justify-center items-start gap-16">
                    <template x-for="(category, name) in subcategories" :key="name">
                        <!-- SubCategory: Can be added, edited, and deleted in dynamic webpage -->
                        <div class="flex flex-col">
                            <h4 class="font-bold text-4xl">
                                <span x-text="name"></span>
                            </h4>
                            <ul class="ml-5 text-xl list-disc">
                                <template x-for="element in category">
                                    <li x-text="element"></li>
                                </template>
                            </ul>
                        </div>
                    </template>
                </div>
            </div>

            <template x-teleport="body">
                <div x-show="modalOpen" x-cloak x-transition>
                    <?php include 'components/cud_aboutMeModal.php' ?>
                </div>
            </template>
        </div>

        <div
            id="technicalSkillSection"
            x-data="{ ...techSkillComponent(), modalOpen: false }"
            x-init="getData().then(data => loadParseData(data))"
            class="flex flex-col mx-16 my-16">
            <!-- Technical Skills: Can be edited in dynamic webpage -->
            <h3 class="flex flex-row font-bold text-6xl items-center">
                Technical Skills
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div
                        @click="
                            openModal();
                            modalOpen = !modalOpen;
                            document.body.classList.toggle('modal-open', modalOpen);
                        "
                        class="text-2xl mx-3 px-3 py-2 rounded-4xl hover:bg-gray-700 cursor-pointer select-none">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                <?php } ?>
            </h3>
            <div class="flex flex-wrap p-3 justify-center items-start gap-16">
                <template x-for="(category, name) in subcategories" :key="name">
                    <div class="flex flex-col">
                        <h4 class="font-bold text-4xl">
                            <span x-text="name"></span>
                        </h4>
                        <ul class="ml-5 text-xl list-disc">
                            <template x-for="element in category">
                                <li x-text="element"></li>
                            </template>
                        </ul>
                    </div>
                </template>
            </div>

            <template x-teleport="body">
                <div x-show="modalOpen" x-cloak x-transition>
                    <?php include 'components/cud_techSkillModal.php' ?>
                </div>
            </template>
        </div>

        <div
            id="projectSection"
            x-data="{ ...projectComponent(), createModalOpen: false , updateModalOpen: false }"
            x-init="getData().then(data => loadParseData(data))"
            class="flex flex-col mx-16 my-16">
            <h3 class="flex flex-row font-bold text-6xl items-center">
                Projects
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div
                        @click="
                            createModalOpen = !createModalOpen;
                            document.body.classList.toggle('modal-open', createModalOpen);
                        "
                        class="text-2xl mx-3 px-3 py-2 rounded-4xl hover:bg-gray-700 cursor-pointer select-none">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                <?php } ?>
            </h3>

            <!-- Projects: Can be edited in dynamic webpage -->
            <div class="flex flex-wrap p-3 justify-center items-stretch gap-5">
                <template x-for="(project, name) in projects" :key="project.Id">
                    <div class="flex flex-col w-[400px] bg-gray-800 rounded-2xl">
                        <img
                            :src="`images/${project.Image}`"
                            class="w-full min-h-[225px] max-h-[225px] bg-gray-700 rounded-2xl object-contain">
                        <!-- No, 'h-[225px]' does not work. I don't know how. I don't know why. Refer to my life motto. -->

                        <div class="flex flex-col p-5 gap-5 justify-between h-full">
                            <div>
                                <h5 class="font-bold text-xl">
                                    <span x-text="name"></span>
                                </h5>
                                <p class="wrap-break-word font-light text-justify">
                                    <span x-text="project.Description"></span>
                                </p>
                            </div>

                            <div class="flex flex-row justify-around gap-3">
                                <a
                                    :href="project.Link"
                                    target="_blank"
                                    class="w-fit px-5 py-1 border-2 border-white rounded-4xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                                    View GitHub Repository
                                </a>
                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <div
                                        @click="
                                            openUpdateModal(name, project);
                                            updateModalOpen = !updateModalOpen;
                                            document.body.classList.toggle('modal-open', updateModalOpen);
                                        "
                                        class="w-fit px-5 py-1 border-2 border-white rounded-4xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                    <div
                                        @click="deleteProject(project)"
                                        class="w-fit px-5 py-1 border-2 border-white rounded-4xl hover:border-red-500 hover:bg-red-500 hover:text-black duration-150 cursor-pointer select-none">
                                        <i class="fa-solid fa-trash"></i>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </template>

            </div>

            <a
                href="https://github.com/ntpyxl"
                target="_blank"
                class="w-fit mx-auto mt-5 px-12 py-3 border-2 border-white rounded-4xl text-xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                See More - Visit my GitHub
            </a>

            <template x-teleport="body">
                <div x-show="createModalOpen" x-cloak x-transition>
                    <?php include 'components/c_projectModal.php' ?>
                </div>
            </template>
            <template x-teleport="body">
                <div x-show="updateModalOpen" x-cloak x-transition>
                    <?php include 'components/u_projectModal.php' ?>
                </div>
            </template>
        </div>

        <div
            id="educationSection"
            x-data="{ ...educationCertificationComponent(), createModalOpen: false , updateModalOpen: false}"
            x-init="getData().then(data => loadParseData(data))"
            class="flex flex-col mx-16 my-16">
            <h3 class="flex flex-row font-bold text-6xl items-center">
                Education and Certifications
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div
                        @click="
                            createModalOpen = !createModalOpen;
                            document.body.classList.toggle('modal-open', createModalOpen);
                        "
                        class="text-2xl mx-3 px-3 py-2 rounded-4xl hover:bg-gray-700 cursor-pointer select-none">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                <?php } ?>
            </h3>

            <!-- Education and Certifications: Can be edited in dynamic webpage -->
            <div class="flex flex-wrap p-3 justify-center items-stretch gap-5">
                <template x-for="(certification, name) in certifications" :key="certification.Id">
                    <div class="w-[400px] bg-gray-800 rounded-2xl">
                        <div class="flex flex-col p-5 space-y-5">
                            <div class="font-light text-sm text-gray-300">
                                <div class="flex flex-row justify-between">
                                    <p>
                                        <i :class="icons[certification.Type]"></i>
                                        <span x-text="certification.Type"></span>
                                    </p>
                                    <?php if (isset($_SESSION['user_id'])) { ?>
                                        <div class="flex flex-row gap-3">
                                            <div
                                                @click="
                                                    openUpdateModal(name, certification);
                                                    updateModalOpen = !updateModalOpen;
                                                    document.body.classList.toggle('modal-open', updateModalOpen);
                                                "
                                                class="px-2 py-1 hover:bg-gray-600 rounded-2xl cursor-pointer select-none">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </div>
                                            <div
                                                @click="deleteCertificate(certification)"
                                                class="px-2 py-1 hover:bg-gray-600 hover:text-red-400 rounded-2xl cursor-pointer select-none">
                                                <i class="fa-solid fa-trash"></i>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <h5 class="font-bold text-xl">
                                    <span x-text="name"></span>
                                </h5>
                            </div>
                            <p class="wrap-break-word font-light text-justify">
                                <span x-text="certification.Description"></span>
                            </p>
                        </div>
                    </div>
                </template>
            </div>

            <template x-teleport="body">
                <div x-show="createModalOpen" x-cloak x-transition>
                    <?php include 'components/c_educationModal.php' ?>
                </div>
            </template>
            <template x-teleport="body">
                <div x-show="updateModalOpen" x-cloak x-transition>
                    <?php include 'components/u_educationModal.php' ?>
                </div>
            </template>
        </div>

        <div id="contactSection" class="flex flex-col mx-16 my-16">
            <h3 class="font-bold text-6xl">Contacts</h3>

            <h5 class="text-center font-light text-2xl">Interested in my skillset? Contact me below.</h5>

            <div x-data="contactInfoComponent()" x-cloak class="flex flex-wrap p-3 justify-center items-stretch gap-5">
                <template x-for="(contact, name) in contacts" :key="name">
                    <a
                        :href="contact.Link"
                        target="_blank"
                        class="flex flex-col w-[108px] h-[108px] p-3 border-4 border-gray-800 rounded-2xl text-4xl justify-center items-center hover:bg-gray-800 duration-150 cursor-pointer">
                        <i :class="contact.Icon"></i>
                        <p class="mt-2 font-light text-lg">
                            <span x-text="name"></span>
                        </p>
                    </a>
                </template>
            </div>
        </div>
    </main>

</body>

</html>