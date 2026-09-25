import cv2
import numpy as np
import os

img_path = os.path.join("public", "images", "healthy_layer_hens.jpg")
out_path = os.path.join("public", "videos", "hero-dummy.mp4")

if not os.path.exists(img_path):
    print("Image not found:", img_path)
    exit(1)

img = cv2.imread(img_path)
h, w, _ = img.shape
target_w, target_h = 1280, 720
fps = 24
duration_sec = 6
total_frames = fps * duration_sec

fourcc = cv2.VideoWriter_fourcc(*'mp4v')
out = cv2.VideoWriter(out_path, fourcc, fps, (target_w, target_h))

print(f"Generating dummy video from {img_path} to {out_path}...")

for i in range(total_frames):
    # Smooth subtle zoom from 1.0 to 1.1 and subtle pan
    progress = i / float(total_frames)
    # Sine wave for smooth loop
    scale = 1.0 + 0.08 * (0.5 - 0.5 * np.cos(progress * 2 * np.pi))
    
    cur_w = int(target_w / scale)
    cur_h = int(target_h / scale)
    
    # Calculate crop coordinates
    cx = int(w * 0.5 + (progress - 0.5) * 50)
    cy = int(h * 0.5 + (0.5 - progress) * 30)
    
    x1 = max(0, min(w - cur_w, cx - cur_w // 2))
    y1 = max(0, min(h - cur_h, cy - cur_h // 2))
    x2 = x1 + cur_w
    y2 = y1 + cur_h
    
    cropped = img[y1:y2, x1:x2]
    frame = cv2.resize(cropped, (target_w, target_h), interpolation=cv2.INTER_LINEAR)
    
    # Add subtle warm grading
    overlay = frame.copy()
    cv2.putText(overlay, "NOCHI FARM | DEMO PREVIEW", (40, 50), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2, cv2.LINE_AA)
    
    # Blend slightly
    frame = cv2.addWeighted(frame, 0.95, overlay, 0.05, 0)
    out.write(frame)

out.release()
print("Dummy video generated successfully:", out_path)
