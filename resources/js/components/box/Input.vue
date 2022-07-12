<template>
    <div :class="cols">
        <template v-for="(item, index) in data">
            <b-row class="my-1" :key="index">
                <template
                    v-if="
                        item.type === 'text' ||
                        item.type === 'number' ||
                        item.type === 'password'
                    "
                >
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-input
                            :disabled="item.disable ? true : false"
                            :id="`type-${item.key}`"
                            :placeholder="item.label"
                            :type="item.type"
                            v-model="value[item.key]"
                        ></b-form-input>
                        <div v-if="errors" style="color: red">
                            {{ errors[item.key] }}
                        </div>
                    </b-col>
                </template>
                <template v-if="item.type === 'checkbox'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-checkbox
                            v-model="value[item.key]"
                            name="check-button"
                            switch
                        ></b-form-checkbox>
                    </b-col>
                </template>
                <template v-if="item.type === 'checkbox-term'">
                    <b-col sm="12" style="display: flex;justify-content: center;">
                        <b-form-checkbox
                            v-model="value[item.key]"
                            name="check-button"
                            switch
                        ></b-form-checkbox>
                        <label :for="`type-${item.key}`">
                            {{ item.label }}</label>
                    </b-col>
                </template>
                <template v-if="item.type === 'editor'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <VueEditor
                            :id="`editor-${item.key}`"
                            v-model="value[item.key]"
                            useCustomImageHandler
                            @image-added="handleImageAdded"
                        ></VueEditor>
                    </b-col>
                </template>
                <template v-if="item.type === 'select'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-select
                            :id="`type-${item.key}`"
                            v-model="value[item.key]"
                            :options="
                                options &&
                                options[item.key] !== undefined &&
                                options[item.key].length > 0
                                    ? options[item.key]
                                    : []
                            "
                            size="md"
                            @change="changeData(item.key, value[item.key])"
                        ></b-form-select>
                        <div v-if="errors" style="color: red">
                            {{ errors[item.key] }}
                        </div>
                    </b-col>
                </template>
                <template v-if="item.type === 'input-tag'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-tags
                            :input-id="`type-${item.key}`"
                            :input-attrs="{
                                'aria-describedby':
                                    'tags-remove-on-delete-help',
                            }"
                            v-model="value[item.key]"
                            separator=" "
                            remove-on-delete
                            no-add-on-enter
                            tag-variant="primary"
                            tag-pills
                        ></b-form-tags>
                        <div v-if="errors" style="color: red">
                            {{ errors[item.key] }}
                        </div>
                    </b-col>
                </template>
                <template v-if="item.type === 'input-select'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-input
                            :list="`type-${item.key}`"
                            :placeholder="item.label"
                            type="text"
                            v-model="value[item.key]"
                        ></b-form-input>
                        <b-form-datalist
                            :id="`type-${item.key}`"
                            text-field="text"
                            size="md"
                        >
                            <option
                                v-for="(data, index) in options &&
                                options[item.key] !== undefined &&
                                options[item.key].length > 0
                                    ? options[item.key]
                                    : []"
                                :key="index"
                                :value="data.value"
                            >
                                {{ data.text }}
                            </option>
                        </b-form-datalist>
                        <div v-if="errors" style="color: red">
                            {{ errors[item.key] }}
                        </div>
                    </b-col>
                </template>
                <template v-if="item.type === 'checkbox-group'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-checkbox-group
                            :id="`type-${item.key}`"
                            v-model="value[item.key]"
                            :options="options[item.key]"
                            name="flavour-1"
                            @change="changeData(item.key, value[item.key])"
                        ></b-form-checkbox-group>

                        <div v-if="errors" style="color: red">
                            {{ errors[item.key] }}
                        </div>
                    </b-col>
                </template>
                <template v-if="item.type === 'radio'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-radio-group
                            :id="`type-${item.key}`"
                            v-model="value[item.key]"
                            :options="options[item.key]"
                            :name="`type-${item.key}`"
                        >
                        </b-form-radio-group>
                        <div v-if="errors" style="color: red">
                            {{ errors[item.key] }}
                        </div>
                    </b-col>
                </template>
                <template v-if="item.type === 'date'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <datepicker
                            :id="`type-${item.key}`"
                            :monday-first="true"
                            v-model="value[item.key]"
                            :bootstrapStyling="true"
                            :name="`${item.key}`"
                            placeholder="Chọn ngày"
                            :format="'dd-MM-yyyy'"
                            :language="vi"
                        >
                        </datepicker>
                        <div v-if="errors" style="color: red">
                            {{ errors[item.key] }}
                        </div>
                    </b-col>
                </template>
                <template v-if="item.type === 'time'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red"> {{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-input
                            type="datetime-local"
                            :id="`type-${item.key}`"
                            :placeholder="item.label"
                            v-model="value[item.key]"
                        />

                        <div v-if="errors" style="color: red">
                            {{ errors[item.key] }}
                        </div>
                    </b-col>
                </template>
                <template v-if="item.type === 'label-title'">
                    <b-col sm="6">
                        <label :for="`type-${item.key}`">
                            {{ item.label }} <small class="small-alert c-red"> {{item.alert}}</small>  :</label
                        >
                    </b-col>
                </template>
                <template v-if="item.type === 'multi-input'">
                    <b-col sm="3">
                        <label :for="`type-${item.key}`">
                            {{ item.label }}<small class="small-alert c-red">{{item.alert}}</small></label
                        >
                    </b-col>
                    <b-col sm="9">
                        <template v-for="(item1, index1) in item.multiInput">
                            <b-row class="my-1" :key="index1">
                                <template
                                    v-if="
                        item1.type === 'text' ||
                        item1.type === 'number' ||
                        item1.type === 'password'
                    "
                                >
                                    <b-col sm="12">
                                        <label :for="`type-${item1.key}`" v-if="item1.label != ''">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="12">
                                        <b-form-input
                                            :disabled="item1.disable ? true : false"
                                            :id="`type-${item1.key}`"
                                            :placeholder="item1.label"
                                            :type="item1.type"
                                            v-model="value[item1.key]"
                                        ></b-form-input>
                                        <div v-if="errors" style="color: red">
                                            {{ errors[item1.key] }}
                                        </div>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'checkbox'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-checkbox
                                            v-model="value[item1.key]"
                                            name="check-button"
                                            switch
                                        ></b-form-checkbox>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'checkbox-term'">
                                    <b-col sm="12">
                                        <b-form-checkbox
                                            v-model="value[item1.key]"
                                            name="check-button"
                                            switch
                                        ></b-form-checkbox>
                                        <label :for="`type-${item1.key}`">
                                        {{ item1.label }}</label>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'editor'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <VueEditor
                                            :id="`editor-${item1.key}`"
                                            v-model="value[item1.key]"
                                            useCustomImageHandler
                                            @image-added="handleImageAdded"
                                        ></VueEditor>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'select'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-select
                                            :id="`type-${item1.key}`"
                                            v-model="value[item1.key]"
                                            :options="
                                options &&
                                options[item1.key] !== undefined &&
                                options[item1.key].length > 0
                                    ? options[item1.key]
                                    : []
                            "
                                            size="md"
                                            @change="changeData(item1.key, value[item1.key])"
                                        ></b-form-select>
                                        <div v-if="errors" style="color: red">
                                            {{ errors[item1.key] }}
                                        </div>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'input-tag'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-tags
                                            :input-id="`type-${item1.key}`"
                                            :input-attrs="{
                                'aria-describedby':
                                    'tags-remove-on-delete-help',
                            }"
                                            v-model="value[item1.key]"
                                            separator=" "
                                            remove-on-delete
                                            no-add-on-enter
                                            tag-variant="primary"
                                            tag-pills
                                        ></b-form-tags>
                                        <div v-if="errors" style="color: red">
                                            {{ errors[item1.key] }}
                                        </div>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'input-select'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input
                                            :list="`type-${item1.key}`"
                                            :placeholder="item1.label"
                                            type="text"
                                            v-model="value[item1.key]"
                                        ></b-form-input>
                                        <b-form-datalist
                                            :id="`type-${item1.key}`"
                                            text-field="text"
                                            size="md"
                                        >
                                            <option
                                                v-for="(data, index1) in options &&
                                options[item1.key] !== undefined &&
                                options[item1.key].length > 0
                                    ? options[item1.key]
                                    : []"
                                                :key="index1"
                                                :value="data.value"
                                            >
                                                {{ data.text }}
                                            </option>
                                        </b-form-datalist>
                                        <div v-if="errors" style="color: red">
                                            {{ errors[item1.key] }}
                                        </div>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'checkbox-group'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-checkbox-group
                                            :id="`type-${item1.key}`"
                                            v-model="value[item1.key]"
                                            :options="options[item1.key]"
                                            name="flavour-1"
                                            @change="changeData(item1.key, value[item1.key])"
                                        ></b-form-checkbox-group>

                                        <div v-if="errors" style="color: red">
                                            {{ errors[item1.key] }}
                                        </div>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'radio'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-radio-group
                                            :id="`type-${item1.key}`"
                                            v-model="value[item1.key]"
                                            :options="options[item1.key]"
                                            :name="`type-${item1.key}`"
                                        >
                                        </b-form-radio-group>
                                        <div v-if="errors" style="color: red">
                                            {{ errors[item1.key] }}
                                        </div>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'date'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <datepicker
                                            :id="`type-${item1.key}`"
                                            :monday-first="true"
                                            v-model="value[item1.key]"
                                            :bootstrapStyling="true"
                                            :name="`${item1.key}`"
                                            placeholder="Chọn ngày"
                                            :format="'dd-MM-yyyy'"
                                            :language="vi"
                                        >
                                        </datepicker>
                                        <div v-if="errors" style="color: red">
                                            {{ errors[item1.key] }}
                                        </div>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'time'">
                                    <b-col sm="3">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input
                                            type="datetime-local"
                                            :id="`type-${item1.key}`"
                                            :placeholder="item1.label"
                                            v-model="value[item1.key]"
                                        />

                                        <div v-if="errors" style="color: red">
                                            {{ errors[item1.key] }}
                                        </div>
                                    </b-col>
                                </template>
                                <template v-if="item1.type === 'label-title'">
                                    <b-col sm="6">
                                        <label :for="`type-${item1.key}`">
                                            {{ item1.label }} <small class="small-alert c-red">{{item1.alert}}</small></label
                                        >
                                    </b-col>
                                </template>
                            </b-row>
                        </template>
                    </b-col>
                </template>
            </b-row>
        </template>
    </div>
</template>

<script>
import datepicker from "vuejs-datepicker";
import { vi } from "vuejs-datepicker/dist/locale";
import { VueEditor } from "vue2-editor/dist/vue2-editor.core.js";
import { BIconTrash } from "bootstrap-vue";
import Datepicker from "vuejs-datetimepicker";
import moment from "moment";
export default {
    components: { datepicker, VueEditor, BIconTrash, Datepicker },
    props: ["data", "options", "value", "cols", "errors"],
    data() {

        return {
            vi: vi,
            text: "",
        };
    },
    mounted() {
        console.log(this.data)
    }
    // methods: {
        // changeData(key, data) {
        //     this.$emit("changeDataSelect", key, data);
        // },
        // onSubmitText(value) {
        //     this.value[value].push(this.text);
        //     this.text = "";
        // },
        // deleteDataInputGroup(value, key) {
        //     const data = this.value[key].filter((item) => item !== value);
        //     this.value[key] = data;
        // },
        // viewDate(value) {
        //     return moment(value).format("DD/MM/YYYYY");
        // },
        // handleImageAdded(file, Editor, cursorLocation, resetUploader) {
        //     new Promise((resolve, reject) => {
        //         const reader = new FileReader();
        //         reader.readAsDataURL(file);
        //         reader.onload = () => resolve(reader.result);
        //         reader.onerror = (error) => reject(error);
        //     }).then(async (data) => {
        //         console.log(data)
        //     });
        // },
    // },
};
</script>

<style lang="scss">
@import "~vue2-editor/dist/vue2-editor.css";

/* Import the Quill styles you want */
@import "~quill/dist/quill.core.css";
@import "~quill/dist/quill.bubble.css";
@import "~quill/dist/quill.snow.css";
</style>
