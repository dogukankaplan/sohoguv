export const getImageUrl = (path) => {
  if (!path) return null;
  if (path.startsWith('http://') || path.startsWith('https://')) {
    return path;
  }
  // If it's a storage path from Laravel, prepend the backend URL
  // Hardcoded to localhost:8000 for now, matching axios.js
  if (path.startsWith('/storage')) {
    return `http://localhost:8000${path}`;
  }
  return path;
};
