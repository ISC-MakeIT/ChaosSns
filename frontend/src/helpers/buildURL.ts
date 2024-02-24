export const buildURL = (baseURL: string, path: string): string => {
  return new URL(path, baseURL).href;
};
