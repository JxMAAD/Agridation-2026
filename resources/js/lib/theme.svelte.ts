import type { Appearance, ResolvedAppearance } from '@/types';

export type { Appearance, ResolvedAppearance };

export type ThemeState = {
    appearance: {
        value: Appearance;
    };
    resolvedAppearance: () => ResolvedAppearance;
    updateAppearance: (value: Appearance) => void;
};

// Always force light mode
const appearance = $state<{ value: Appearance }>({ value: 'light' });

const getResolvedAppearance = (): ResolvedAppearance => {
    return 'light';
};

const applyTheme = (): void => {
    if (typeof document === 'undefined') {
        return;
    }

    document.documentElement.classList.remove('dark');
    document.documentElement.style.colorScheme = 'light';
};

export function initializeTheme(): () => void {
    if (typeof window === 'undefined') {
        return () => {};
    }

    applyTheme();

    return () => {};
}

export function updateAppearance(_value: Appearance): void {
    // No-op to maintain API but enforce light mode
    applyTheme();
}

export function themeState(): ThemeState {
    return {
        appearance,
        resolvedAppearance: getResolvedAppearance,
        updateAppearance,
    };
}
