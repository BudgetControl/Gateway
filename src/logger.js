export function logRequest(event) {
  console.log('URL:', event.rawPath);
  console.log('Headers:', JSON.stringify(event.headers));
  console.log('Body:', event.body);
}
