<template>
  <div>
    <el-form
      ref="elForm"
      :model="formData"
      :rules="rules"
      size="mini"
      label-width="100px"
      label-position="left"
    >
      <el-form-item label="文章标题" prop="title">
        <el-input
          v-model="formData.title"
          placeholder="请输入文章标题"
          clearable
          :style="{ width: '100%' }"
        >
        </el-input>
      </el-form-item>
      <el-form-item label="文章描述" prop="desc">
        <el-input
          v-model="formData.desc"
          placeholder="请输入文章描述"
          clearable
          :style="{ width: '100%' }"
        ></el-input>
      </el-form-item>
      <el-form-item label="选择作者" prop="author">
        <el-select
          v-model="formData.author"
          placeholder="请选择选择作者"
          clearable
          :style="{ width: '100%' }"
        >
          <el-option
            v-for="(item, index) in authorOptions"
            :key="index"
            :label="item.label"
            :value="item.value"
            :disabled="item.disabled"
          ></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="文章内容" prop="content">
        <el-input
          v-model="formData.content"
          type="textarea"
          placeholder="请输入文章内容"
          :autosize="{ minRows: 4, maxRows: 4 }"
          :style="{ width: '100%' }"
        ></el-input>
      </el-form-item>
      <el-form-item label="选择标签" prop="tag">
        <el-checkbox-group v-model="formData.tag" size="mini">
          <el-checkbox
            v-for="(item, index) in tagOptions"
            :key="index"
            :label="item.value"
            :disabled="item.disabled"
            >{{ item.label }}</el-checkbox
          >
        </el-checkbox-group>
      </el-form-item>
      <el-form-item size="large">
        <el-button type="primary" @click="submitForm">提交</el-button>
        <el-button @click="resetForm">重置</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
import infoList from "@/components/mixins/infoList";

export default {
  components: {},
  mixins: [infoList],
  props: { formData: Object, authorOptions: Array, tagOptions: Array },
  data() {
    return {
      rules: {
        title: [
          {
            required: true,
            message: "请输入文章标题",
            trigger: "blur",
          },
        ],
        desc: [
          {
            required: true,
            message: "请输入文章描述",
            trigger: "blur",
          },
        ],
        author: [
          {
            required: true,
            message: "请选择选择作者",
            trigger: "change",
          },
        ],
        content: [
          {
            required: true,
            message: "请输入文章内容",
            trigger: "blur",
          },
        ],
        tag: [
          {
            required: true,
            type: "array",
            message: "请至少选择一个选择标签",
            trigger: "change",
          },
        ],
      },
    };
  },
  computed: {},
  watch: {},
  created() {},
  mounted() {},
  methods: {
    submitForm() {
      this.$refs["elForm"].validate((valid) => {
        if (!valid) return;
        // TODO 提交表单
      });
    },
    resetForm() {
      this.$refs["elForm"].resetFields();
    },
  },
};
</script>
<style>
</style>
