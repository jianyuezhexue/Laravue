<template>
  <div>
    <el-form ref="elForm" :model="formData" :rules="rules" size="mini" label-width="100px" label-position="left">
      <el-form-item label="文章标题" prop="title">
        <el-input v-model="formData.title" placeholder="请输入文章标题" clearable :style="{ width: '100%' }" ></el-input>
      </el-form-item>
      <el-form-item label="文章描述" prop="desc">
        <el-input v-model="formData.desc" placeholder="请输入文章描述" clearable :style="{ width: '100%' }" ></el-input>
      </el-form-item>
      <el-form-item label="选择作者" prop="author">
        <el-input v-model="formData.author" placeholder="请输入作者姓名" clearable :style="{ width: '100%' }"></el-input>
      </el-form-item>
      <el-form-item label="文章内容" prop="content">
        <el-input v-model="formData.content" type="textarea" placeholder="请输入文章内容" :autosize="{ minRows: 4, maxRows: 4 }" :style="{ width: '100%' }"></el-input>
      </el-form-item>
      <el-form-item label="选择标签" prop="tag">
        <el-input v-model="formData.tag" placeholder="请输入文章标签" clearable :style="{ width: '100%' }"></el-input>
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
  props: { formData: Object},
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
            message: "请输入作者",
            trigger: "blur",
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
            message: "请输入文章标签",
            trigger: "blur",
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
