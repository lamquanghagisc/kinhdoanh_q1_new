<?php

use app\modules\contrib\gxassets\GxVueDualListboxAsset;
use yii\helpers\Html;

GxVueDualListboxAsset::register($this);
$options = json_encode($items);
$displayProperty = json_encode($displayProperty);
$valueProperty =  json_encode($valueProperty);
$inputName = Html::getInputName($model, $attribute);
$value = json_encode($model->$attribute);
$this->registerJs(
    <<<JS
    if(!window.vueapp){
        window.vueapp = new Vue({el: '#app'});
    }
    const child = new Vue({
        template: `
        <div>
            <VueMultiSelectListbox 
                :options="options"
                v-model="value"
                :reduce-display-property="(option) => option[displayProperty]"
                :reduce-value-property="(option) => option[valueProperty]"
                search-options-placeholder="Tìm kiếm"
                selected-options-placeholder="Tìm kiếm trên danh sách đã chọn"
            />
            <template v-if="value && value.length">
                <input  v-for="v in value" type="hidden" :value="v" name="$inputName\[]"/>
            </template>
            <input v-else  type="hidden"  name="$inputName"/>
         
        </div>
        `,
        components: {VueMultiSelectListbox: VueMultiSelectListbox.default},
        data(){
            return {
                options: $options,
                displayProperty: $displayProperty,
                valueProperty: $valueProperty,
                value: $value
            }
        },
        mounted(){
            this.value = this.value.filter(val => this.options.findIndex(option => option[this.valueProperty]==val) >=0)
        }
    });
    child.\$mount()
    window.vueapp.\$refs.duallistbox1.appendChild(child.\$el)

JS
);

$this->registerCss("
.msl-search-list-input{
    font-size: 0.9rem;
}
.msl-multi-select {
    width: 100%;
}
");

?>

<div ref="duallistbox1">

</div>