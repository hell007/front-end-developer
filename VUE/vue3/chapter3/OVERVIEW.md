# 渲染器原理及实现

完整目录

  - [渲染器原理及实现](#渲染器原理及实现)
    - [1. 编译器和渲染器 API 初探](#1-编译器和渲染器-api-初探)
      - [Complier 和 Renderer](#complier-和-renderer)
      - [编译器（Complier）真实场景](#编译器complier真实场景)
    - [2. 设计 VNode](#2-设计-vnode)
      - [用 VNode 描述 HTML](#用-vnode-描述-html)
      - [用 VNode 描述抽象内容](#用-vnode-描述抽象内容)
      - [区分 VNode 类型](#区分-vnode-类型)
      - [区分 children 的类型](#区分-children-的类型)
      - [定义 VNode](#定义-vnode)
    - [3. 生成 VNode 的 h 函数](#3-生成-vnode-的-h-函数)
      - [基本的 h 函数](#基本的-h-函数)
      - [完整的 h 函数](#完整的-h-函数)
    - [4. 渲染 VNode 的 mount 函数](#4-渲染-vnode-的-mount-函数)
      - [mount 函数基本原理](#mount-函数基本原理)
      - [解决 `VNode` 的类型问题](#解决-vnode-的类型问题)
        - [渲染文本节点](#渲染文本节点)
        - [渲染标签节点](#渲染标签节点)
        - [渲染普通有状态组件](#渲染普通有状态组件)
        - [渲染函数式组件](#渲染函数式组件)
      - [设置 DOM 属性](#设置-dom-属性)
      - [渲染子节点](#渲染子节点)
      - [关联 `VNode` 及其 DOM](#关联-vnode-及其-dom)
      - [完整实现](#完整实现)
      - [完整示例](#完整示例)
    - [5. 实现 patch 函数](#5-实现-patch-函数)
      - [patch 的作用](#patch-的作用)
      - [patch 函数实现](#patch-函数实现)
        - [比较 props](#比较-props)
        - [比较 children](#比较-children)
      - [完整实现](#完整实现)
      - [完整示例](#完整示例)
    - [6. patch 函数优化](#patch-函数优化)
      - [准备工作](#准备工作)
      - [简单的 diff 算法](#简单的-diff-算法)
      - [优化版本的 diff 算法](#优化版本的-diff-算法)
        - [新增节点](#新增节点)
        - [删除节点](#删除节点)
      - [关于核心 diff 算法](#关于核心-diff-算法)
        - [Vue 2 diff 算法](#vue-2-diff-算法)
        - [Vue 3 diff 算法](#vue-3-diff-算法)

本章节将带你实现Vue 3的渲染器功能，分为如下几部分来讲解。

## 1. 编译器和渲染器 API 初探
[点此学习](./1.API.md)

## 2. 设计 VNode
[点此学习](./2.VNODE.md)

## 3. 生成 VNode 的 h 函数
[点此学习](./3.HFUNCTION.md)

## 4. 渲染 VNode 的 mount 函数
[点此学习](./4.MOUNT.md)

## 5. 实现 patch 函数
[点此学习](./5.PATCH.md)

## 6. patch 函数的优化
[点此学习](./5.DIFF.md)


[下一章 - Reactivity响应式设计](../chapter4/OVERVIEW.md)

