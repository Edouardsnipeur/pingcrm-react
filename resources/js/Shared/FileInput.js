import React, { useState, useRef } from 'react';
import { filesize } from '@/utils';

const Button = ({ text, onClick }) => (
  <button
    type="button"
    className="px-4 py-1 text-xs font-medium text-white bg-gray-600 rounded-sm focus:outline-none hover:bg-gray-700"
    onClick={onClick}
  >
    {text}
  </button>
);

export default ({ className, name, label, accept, errors = [], onChange }) => {
  const fileInput = useRef();
  const [files, setFiles] = useState([]);

  function browse() { 
    fileInput.current.click();
  }

  function remove(index) {
    files.splice(index, 1);
    setFiles([...files]);
    // console.log(files);
    onChange(files);
    fileInput.current.value = null;
  }

  function handleFileChange(e) {
    const files = e.target.files;
    // console.log([...files]);
    setFiles([...files]);
    onChange(files);
  }

  return (
    <div className={className}>
      {label && (
        <label className="form-label" htmlFor={name}>
          {label}:
        </label>
      )}
      <div className={`form-input p-0 ${errors.length && 'error'}`}>
        <input
          id={name}
          ref={fileInput}
          accept={accept}
          type="file"
          className="hidden"
          onChange={handleFileChange}
          multiple
        />
        {files.length==0 && (
          <div className="p-2">
            <Button text="Browse" onClick={browse} />
          </div>
        )}
        {files.length!==0 && (
          <div className="flex flex-col p-2">
            {
              files.map((file, key) => {
                return <div className="flex-1 flex-row" key={key}>
                  <div className="flex-3 pr-1">
                    {file.name}
                    <span className="ml-1 text-xs text-gray-600">
                      ({filesize(file.size)})
                    </span>
                  </div>
                  <div className="flex-1">
                    <Button text="Remove" onClick={()=>remove(key)} />
                  </div>
                </div>
              })
            }
            
          </div>
        )}
      </div>
      {errors.length > 0 && <div className="form-error">{errors}</div>}
    </div>
  );
};
