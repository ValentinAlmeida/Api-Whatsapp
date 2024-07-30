<template>
    <v-layout class="menu">
        <v-navigation-drawer
        expand-on-hover
        rail
        >
            <v-list>
                <v-list-item
                    prepend-avatar="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn1.iconfinder.com%2Fdata%2Ficons%2Fuser-pictures%2F100%2Funknown-1024.png&f=1&nofb=1&ipt=cb6feb5172ac804cff6dd86da745d9f484132f1368e7124b104bfd8d8267423e&ipo=images"
                    subtitle="sandra_a88@gmailcom"
                    title="Sandra Adams"
                ></v-list-item>
            </v-list>

            <v-divider></v-divider>

            <v-list nav>
                <v-list-item prepend-icon="mdi-folder" title="My Files" value="myfiles"></v-list-item>
                <v-list-item prepend-icon="mdi-account-multiple" title="Shared with me" value="shared"></v-list-item>
                <v-list-item prepend-icon="mdi-star" title="Starred" value="starred"></v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-main style="height: 250px"></v-main>
    </v-layout>
</template>
