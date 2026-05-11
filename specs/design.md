# InterviewPrep — Design System

## Design Vision

InterviewPrep uses a modern dark SaaS interface designed for developers preparing technical interviews.

The interface must feel:

* Professional
* Technical
* Minimal
* Focused
* Modern
* Calm
* AI oriented

Main inspiration:

* Linear
* Raycast
* Vercel
* Modern developer dashboards

---

# Color Palette

## Primary Palette

| Name            | Hex     | Usage                        |
| --------------- | ------- | ---------------------------- |
| Evergreen       | #041b15 | Main background              |
| Blue Spruce     | #136f63 | Cards and secondary surfaces |
| Light Sea Green | #22aaa1 | Primary actions              |
| Turquoise       | #4ce0d2 | Hover states and highlights  |
| Sky Blue Light  | #84cae7 | Accent information           |

---

# Theme Rules

## Backgrounds

| Element          | Color   |
| ---------------- | ------- |
| Main background  | #041b15 |
| Sidebar          | #0a2c24 |
| Card background  | #136f63 |
| Modal background | #0f3c35 |

---

## Text Colors

| Element        | Color   |
| -------------- | ------- |
| Primary text   | #ffffff |
| Secondary text | #b8d9d5 |
| Muted text     | #84cae7 |

---

## Buttons

## Primary Button

| Property   | Value   |
| ---------- | ------- |
| Background | #22aaa1 |
| Hover      | #4ce0d2 |
| Text       | #041b15 |
| Radius     | 14px    |

## Secondary Button

| Property   | Value       |
| ---------- | ----------- |
| Background | transparent |
| Border     | #22aaa1     |
| Text       | #4ce0d2     |

---

# Typography

## Font Family

Use:

* Inter
* Geist
* Poppins

Fallback:

* sans-serif

---

## Font Sizes

| Element       | Size |
| ------------- | ---- |
| Page title    | 36px |
| Section title | 28px |
| Card title    | 22px |
| Body text     | 16px |
| Small text    | 14px |

---

# Layout Rules

## Global Spacing

| Element           | Value |
| ----------------- | ----- |
| Section padding   | 32px  |
| Card padding      | 24px  |
| Gap between cards | 20px  |
| Border radius     | 18px  |

---

# Shadows

## Card Shadow

```css
box-shadow:
0 8px 32px rgba(0,0,0,0.25);
```

---

# Borders

```css
border:
1px solid rgba(255,255,255,0.08);
```

---

# Glassmorphism Style

Apply to:

* Modals
* Dashboard cards
* Statistics widgets

```css
background: rgba(19,111,99,0.45);
backdrop-filter: blur(12px);
```

---

# Dashboard Design

## Structure

Layout:

* Left sidebar
* Top navigation
* Statistics cards
* Domains grid
* Recent concepts section

---

## Sidebar

Color:

* #041b15

Active item:

* Background #22aaa1
* Text #041b15

Icons:

* Lucide icons
* Outline style

---

# Domain Cards

## Card Style

Background:

* #136f63

Hover:

* translateY(-4px)
* subtle glow

Progress bar:

* #4ce0d2

Mastered concepts:

* #84cae7

---

# Concepts Table

## Difficulty Colors

| Difficulty | Color   |
| ---------- | ------- |
| Junior     | #4ce0d2 |
| Mid        | #84cae7 |
| Senior     | #22aaa1 |

---

## Status Colors

| Status      | Color   |
| ----------- | ------- |
| Review      | #ff7675 |
| In Progress | #ffeaa7 |
| Mastered    | #4ce0d2 |

---

# AI Section Design

## AI Generation Card

Background:

* linear-gradient(
  135deg,
  #136f63,
  #22aaa1
  )

Button glow:

* #4ce0d2

AI icon:

* animated pulse

---

# Animations

## Hover Animation

```css
transition:
all 0.25s ease;
```

---

## Card Hover

```css
transform:
translateY(-4px);
```

---

## Button Hover

```css
filter:
brightness(1.08);
```

---

# Inputs

## Input Style

```css
background: #0c2f28;
border: 1px solid #136f63;
color: white;
border-radius: 12px;
padding: 12px 16px;
```

Focus:

```css
border-color: #4ce0d2;
box-shadow:
0 0 0 4px rgba(76,224,210,0.15);
```

---

# Tables

## Table Header

Background:

* #0d312a

Text:

* #84cae7

---

# Empty States

Illustration style:

* Minimal
* Developer themed
* AI themed

Text:

* Calm and encouraging

---

# Mobile Design

Responsive rules:

* Sidebar collapses
* Cards stack vertically
* Statistics become carousel
* Buttons full width

Breakpoint:

* 768px

---

# Tailwind Mapping

## Recommended Tailwind Classes

```txt
bg-[#041b15]
bg-[#136f63]
bg-[#22aaa1]
text-[#4ce0d2]
text-[#84cae7]
border-[#22aaa1]
hover:bg-[#4ce0d2]
```

---

# UI Inspirations

Use inspiration from:

* Linear
* Vercel Dashboard
* Raycast
* GitHub Projects
* Supabase

---

# Final UI Feeling

The application should feel:

* Premium
* Technical
* AI powered
* Minimal
* Fast
* Modern
* Focused on developer productivity
