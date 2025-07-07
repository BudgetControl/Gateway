import { CognitoJwtVerifier } from 'aws-jwt-verify';

const verifier = CognitoJwtVerifier.create({
  userPoolId: process.env.COGNITO_USER_POOL_ID,
  tokenUse: 'access',
  clientId: process.env.COGNITO_CLIENT_ID
});

export async function validateCognitoToken(token, username) {
  const payload = await verifier.verify(token);
  if (payload.username !== username) {
    throw new Error('Username mismatch');
  }
  return payload;
}
