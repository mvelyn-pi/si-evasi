---
name: Sistem Evaluasi SAKTI
colors:
  surface: '#faf9fc'
  surface-dim: '#dad9dd'
  surface-bright: '#faf9fc'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f4f3f6'
  surface-container: '#eeedf1'
  surface-container-high: '#e9e8eb'
  surface-container-highest: '#e3e2e5'
  on-surface: '#1a1c1e'
  on-surface-variant: '#43474e'
  inverse-surface: '#2f3033'
  inverse-on-surface: '#f1f0f3'
  outline: '#73777f'
  outline-variant: '#c3c6cf'
  surface-tint: '#436084'
  primary: '#002444'
  on-primary: '#ffffff'
  primary-container: '#1b3a5c'
  on-primary-container: '#87a4cc'
  inverse-primary: '#abc9f2'
  secondary: '#1f6298'
  on-secondary: '#ffffff'
  secondary-container: '#8ac3ff'
  on-secondary-container: '#005084'
  tertiary: '#331f00'
  on-tertiary: '#ffffff'
  tertiary-container: '#4f3300'
  on-tertiary-container: '#c49b5f'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d2e4ff'
  primary-fixed-dim: '#abc9f2'
  on-primary-fixed: '#001c38'
  on-primary-fixed-variant: '#2b486b'
  secondary-fixed: '#d0e4ff'
  secondary-fixed-dim: '#9bcbff'
  on-secondary-fixed: '#001d34'
  on-secondary-fixed-variant: '#004a7a'
  tertiary-fixed: '#ffddb1'
  tertiary-fixed-dim: '#ecbf80'
  on-tertiary-fixed: '#291800'
  on-tertiary-fixed-variant: '#5f410c'
  background: '#faf9fc'
  on-background: '#1a1c1e'
  surface-variant: '#e3e2e5'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 28px
    fontWeight: '700'
    lineHeight: 36px
  display-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
  display-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 22px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 13px
    fontWeight: '500'
    lineHeight: 18px
  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.02em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  container-max: 1440px
  gutter: 1.5rem
  margin-mobile: 1rem
  margin-desktop: 2rem
  stack-sm: 0.5rem
  stack-md: 1rem
  stack-lg: 1.5rem
---

## Brand & Style
The design system is engineered for the "SISTEM EVALUASI SAKTI," an Indonesian government platform requiring high levels of authority, reliability, and clarity. The brand personality is institutional and meticulous, designed to foster a sense of security and officiality for government administrators and evaluators.

The design style follows a **Corporate / Modern** approach with a focus on functional minimalism. It prioritizes information density and legibility over decorative elements. The UI avoids any form of glassmorphism, heavy shadows, or aggressive animations in favor of a stable, grounded interface that reflects the seriousness of governmental evaluation processes. Visual hierarchy is established through precise alignment, consistent spacing, and a disciplined color application.

## Colors
The palette is rooted in institutional blues and functional grays to communicate trust and stability.

- **Primary Navy (#1B3A5C):** Reserved for core structural elements including the sidebar, header, and primary action buttons.
- **Medium Blue (#2E6DA4):** Used for interactive states, such as active navigation links, selected tabs, and interactive badges.
- **Surface & Background:** A light gray background (#F5F7FA) provides a soft contrast against white (#FFFFFF) content cards and input fields, reducing eye strain during long evaluation sessions.
- **Semantic Colors:** Success (Green), Warning (Amber), and Danger (Red) are utilized exclusively for status indicators, validation feedback, and critical alerts to maintain a serious and professional tone.

## Typography
The system utilizes two distinct typefaces to balance modern aesthetics with functional legibility.

- **Headlines (Plus Jakarta Sans):** Used for page titles and section headers to provide a clean, approachable, and contemporary Indonesian government feel.
- **Body & UI (Inter):** The primary workhorse font for all evaluation data, tables, and form labels. It is chosen for its exceptional readability in data-heavy environments.
- **Sizing:** The base body text is set to 14px to maximize information density while maintaining accessibility. Labels use 13px to create clear hierarchical distinction in forms.
- **Formal Indonesian:** All UI microcopy must use formal Indonesian (Bahasa Indonesia Baku) to maintain institutional standards.

## Layout & Spacing
The design system employs a **Fixed Grid** model for desktop to ensure data consistency across different displays, centering content within a 1440px max-width container.

- **Grid System:** A standard 12-column grid with 24px (1.5rem) gutters.
- **Sidebar:** A fixed left-hand navigation sidebar (260px width) utilizing the Primary Navy background.
- **Mobile Adaptation:** On mobile devices, the layout shifts to a single column with 16px margins. Complex data tables should utilize horizontal scrolling or card-view transformations to preserve data integrity.
- **Consistency:** Use an 8px-based spacing scale for all internal element margins and padding to ensure mathematical harmony across the UI.

## Elevation & Depth
In alignment with the serious and official tone, this design system uses **Low-contrast outlines** and minimal elevation.

- **Surface Tiers:** Hierarchy is created primarily through color blocking (White cards on Light Gray backgrounds) rather than shadows.
- **Shadows:** Only one level of shadow is permitted: a very subtle `0 1px 4px rgba(0, 0, 0, 0.05)` applied to cards and containers to provide just enough separation from the background.
- **Dividers:** Use 1px solid borders (#DDE3EC) for horizontal and vertical rules within cards and tables to maintain structure without adding visual noise.

## Shapes
The shape language is professional and restrained, avoiding overly circular "playful" geometry.

- **Cards:** Use a radius of 8px to define the primary content containers.
- **Components:** Buttons and input fields use a slightly tighter 6px radius, providing a crisp, modern appearance that feels structured.
- **Badges:** As an exception to the geometric rule, status badges use a pill-shaped (fully rounded) format to clearly distinguish them from interactive buttons.

## Components
Consistent implementation of these components ensures the interface feels unified and professional.

- **Buttons:** 
  - *Primary:* Solid #1B3A5C with white text. 
  - *Secondary:* 1.5px border in #1B3A5C with #1B3A5C text.
  - *Sizing:* Height of 40px for standard actions; 32px for table-row actions.
- **Inputs:** 1.5px solid border (#DDE3EC) with 6px radius. Focused state transitions to #2E6DA4 border color with no glow/blur.
- **Cards:** White background, 8px radius, 1px border (#DDE3EC), and the defined subtle shadow.
- **Badges:** Pill-shaped. Use low-opacity versions of the status colors for backgrounds (e.g., 10% opacity) with the full-saturation color for text to ensure high legibility and a refined look.
- **Data Tables:** High-density layout, #FFFFFF background, subtle #DDE3EC bottom-border for rows. Header rows should have a very light gray tint (#F8FAFC) to distinguish from data.
- **Navigation:** Sidebar links use #FFFFFF text with 60% opacity for inactive states and 100% opacity + #2E6DA4 left-accent border for active states.