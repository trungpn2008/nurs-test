import { reactive } from 'vue'
export const store = reactive({
    register: [],
    addDataRegister(r){
        this.register = r
    }
})
