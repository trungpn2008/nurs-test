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
            <font-awesome-icon
                :icon="['fas', 'camera']"
                class="round_circle_camera"
                @click="openFile()"
            />
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
.avatar {
    position: relative;

    img {
        display: block;
    }

    .round-camera {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #e4e6eb;
        border: 2px solid white;
        transform: translate(-50%, -50%);

        .round_circle_camera {
            color: #333;
            font-size: 20px;
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    }
}
</style>
