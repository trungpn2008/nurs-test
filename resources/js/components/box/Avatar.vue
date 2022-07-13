<template>
    <div class="avatar" :style="rounded == '0' ? 'border-radius: unset;' : ''">
        <input type="file" hidden ref="file" @change="changeData" />
        <b-img
            :rounded="rounded"
            @click="openFile()"
            v-bind:src="(image && typeof image === 'string') ? image : preview"
            :width="240"
            :height="240"
        />
        <div class="round-camera">
            <b-img src="/images/frontend/icons/Camera.png" class="round_circle_camera" @click="openFile()"></b-img>
<!--            <font-awesome-icon-->
<!--                :icon="['fas', 'camera']"-->
<!--                class="round_circle_camera"-->
<!--                @click="openFile()"-->
<!--            />-->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            preview: null,
        };
    },
    props: {
        image: {
            type: String,
            default: null,
        },
        rounded: {
            type: String,
            default: "circle",
        },
    },
    methods: {
        openFile() {
            this.$refs.file.click();
        },
        changeData(event) {
            let input = event.target;
            if (input.files) {
                 new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = () => resolve(reader.result);
                reader.onerror = (error) => reject(error);
            }).then(async (data) => {
                this.$emit("imageFileBase64", data);
            });
            //     let reader = new FileReader();
            //     reader.onload = (e) => {
            //         this.preview = e.target.result;
            //     };
            //     reader.readAsDataURL(input.files[0]);
                this.$emit("imageFile", input.files[0]);
            //     this.$emit("imageFileBase64", reader.result);
            }
        },
    },
};
</script>

<style lang="scss">

</style>
