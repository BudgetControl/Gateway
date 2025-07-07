import jwt from 'jsonwebtoken';

// Usa la tua chiave segreta (o publicKey se RSA)
const secret = process.env.JWT_SECRET;

export function decodeToken(token) {
  return jwt.verify(token, secret);
}
