#!/usr/bin/env bash
# Vendor firebase/php-jwt into components/OssnAuthentikLogin/vendor/firebase/php-jwt/.
# Run from anywhere; the script resolves its own location.
#
# The downloaded tarball is verified against a pinned SHA-256 before extraction.
# If you bump VERSION, regenerate EXPECTED_SHA256 with:
#   curl -fsSL "https://github.com/firebase/php-jwt/archive/refs/tags/<VERSION>.tar.gz" | sha256sum
set -euo pipefail

VERSION="v6.10.2"
EXPECTED_SHA256="40ffce00d2a3df5d7a16648f3a874f4df64ef92bbdc3141a8bd158d952d73bc2"

HERE="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"
TARGET="${HERE}/firebase/php-jwt"

mkdir -p "${TARGET}"
echo "Fetching firebase/php-jwt ${VERSION} → ${TARGET}"

TMP="$(mktemp -d)"
trap 'rm -rf "${TMP}"' EXIT

TARBALL="${TMP}/php-jwt.tar.gz"
curl -fsSL "https://github.com/firebase/php-jwt/archive/refs/tags/${VERSION}.tar.gz" -o "${TARBALL}"

# Verify the tarball against the pinned hash before extracting anything.
# A mismatch means either the upstream tag was re-pointed, GitHub's archive
# format changed, or the download was tampered with — in any case, abort.
echo "${EXPECTED_SHA256}  ${TARBALL}" | sha256sum -c -

tar -xz -C "${TMP}" -f "${TARBALL}"

# Copy only the src/ directory; the rest (tests, ci config) we don't need.
SRC_DIR="$(find "${TMP}" -maxdepth 2 -type d -name src | head -1)"
if [ -z "${SRC_DIR}" ]; then
    echo "Could not locate src/ in downloaded archive" >&2
    exit 1
fi
rm -rf "${TARGET}/src"
cp -R "${SRC_DIR}" "${TARGET}/src"

echo "Done. Verify:"
ls -1 "${TARGET}/src"
